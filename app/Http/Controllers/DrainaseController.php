<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Drainase;
use App\Models\DrainaseDetail;
use App\Models\DrainaseFile;
use DataTables;
use Str;
use Validator;
use Storage;
use PDF;

class DrainaseController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index()
  {

    if (request()->ajax()) {
      $data = Drainase::latest()->get();
      return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('tgl',function($row){
        $tgl = date('d/m/Y',strtotime($row->tanggal));
        return $tgl;
      })
      ->addColumn('action', function($row){

        $btn = '<a href="'.route('drainase.show',['uuid'=>$row->uuid]).'" class="edit btn btn-success btn-sm">Detail</a>';

        $btn = $btn.' <a href="'.route('drainase.edit',['uuid'=>$row->uuid]).'" class="edit btn btn-primary btn-sm">Ubah</a>';

        $btn = $btn.' <a href="'.route('drainase.destroy',['uuid'=>$row->uuid]).'" class="btn btn-danger btn-sm hapus">Hapus</a>';

        return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    $data = [
      'title'=>'Data Drainase  - TERAS'
    ];

    return view('drainase.index',$data);

  }

  public function create()
  {
    $data = [
      'title'=>'Tambah Data Drainase  - TERAS'
    ];

    return view('drainase.create',$data);
  }

  public function store(Request $r)
  {

    $fotos = [];
    if ($r->hasFile('file_foto')) {
      $foto = $r->file('file_foto');
      $allowed_ext = ['jpg','jpeg','png'];

      foreach ($foto as $key => $f) {
        $foto_ext = $f->getClientOriginalExtension();

        if ($f->getSize() > (2048*1000)) {
          return redirect()->back()->withErrors('Ukuran File tidak boleh lebih dari 2MB')->withInput();
        }elseif (!in_array(strtolower($foto_ext),$allowed_ext)) {
          return redirect()->back()->withErrors('File harus berekstensi jpg, jpeg, atau png')->withInput();
        }

      }

      foreach ($foto as $key => $f) {
        $foto_name = $f->getClientOriginalName();
        $foto_ext = $f->getClientOriginalExtension();

        $filepath = $f->store('drainase_foto');

        $fotos[$filepath] = pathinfo($foto_name,PATHINFO_FILENAME);

      }

    }

    $drainase = Drainase::updateOrCreate(['uuid' => $r->uuid],
    [
      'uuid' => (string)Str::uuid(),
      'nama_jalan' => $r->nama_jalan,
      'sta' => $r->sta,
      'tanggal' => $r->tanggal
    ]);

    $dataKanan = $r->kanan;
    $dataKiri = $r->kiri;

    array_push($dataKanan,['posisi'=>'kanan']);
    array_push($dataKiri,['posisi'=>'kiri']);

    $drainase->detail()->updateOrCreate(['posisi'=>'kanan'],$dataKanan);
    $drainase->detail()->updateOrCreate(['posisi'=>'kiri'],$dataKiri);

    if (count($fotos)) {
      $insertFile = [];
      foreach ($fotos as $key => $f) {
        $insertFile[] = new DrainaseFile([
          'uuid'=>(string)Str::uuid(),
          'nama'=>$f,
          'path'=>$key,
          'tipe'=>'dokumentasi'
        ]);
      }

      $drainase->foto()->saveMany($insertFile);
    }

    return redirect()->route('drainase.index')->with('message','Data Berhasil Disimpan');
  }

  public function edit($uuid)
  {

    $drainase = Drainase::where('uuid',$uuid)->with('detail')->with('foto')->first();

    $data = [
      'title'=>'Ubah Data Drainase  - TERAS',
      'data'=>$drainase
    ];

    return view('drainase.edit',$data);
  }

  public function show($uuid)
  {
    $drainase = Drainase::where('uuid',$uuid)->with('detail')->first();

    if (!$drainase) {
      return redirect()->route('drainase.index');
    }

    $data = [
      'title'=>'Detail Drainase '.$drainase->nama_jalan.'  - TERAS',
      'data'=>$drainase
    ];

    return view('drainase.show',$data);
  }

  public function destroy($uuid)
  {
    $drainase = Drainase::where('uuid',$uuid)->first();
    $drainase->detail()->delete();
    foreach ($drainase->foto as $key => $foto) {
      Storage::delete($foto->path);
    }
    $drainase->foto()->delete();
    $drainase->delete();

    return redirect()->route('drainase.index')->with('message','Data Berhasil Dihapus');
  }

  public function deleteFoto(Request $r)
  {
    if ($r->ajax()) {
      $foto = DrainaseFile::where('uuid',$r->uuid)->first();
      Storage::delete($foto->path);
      if ($foto->delete()) {
        return response()->json(['status'=>true]);
      }
      return response()->json(['status'=>false]);
    }
    return redirect()->route('drainase.index');
  }

  public function printSingle($uuid)
  {
    $drainase = Drainase::where('uuid',$uuid)->with('detail')->first();

    $pdf = PDF::loadView('drainase.print-single',[
      'title'=>'Drainase Jalan '.$drainase->nama_jalan,
      'data'=>$drainase
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'potrait')->stream('Drainase '.$drainase->nama_jalan);
  }

  public function printAll()
  {
    $drainase = Drainase::with('detail')->get();

    $pdf = PDF::loadView('drainase.print-all',[
      'title'=>'Data Drainase',
      'data'=>$drainase
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'landscape')->stream('Data Drainase');
  }
}
