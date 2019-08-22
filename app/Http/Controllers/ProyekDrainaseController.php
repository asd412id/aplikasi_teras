<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\DrainaseProyek;
use DataTables;
use Str;
use Validator;
use Storage;
use PDF;

class ProyekDrainaseController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index()
  {

    if (request()->ajax()) {
      $data = DrainaseProyek::latest()->get();
      return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('jp',function($row){
        $dt = ucwords($row->jenis_pekerjaan);
        return $dt;
      })
      ->addColumn('angg',function($row){
        $dt = strtoupper($row->anggaran);
        return $dt;
      })
      ->addColumn('tgl',function($row){
        $tgl = date('d/m/Y',strtotime($row->tanggal));
        return $tgl;
      })
      ->addColumn('action', function($row){

        $btn = '<a href="'.route('proyek-drainase.edit',['uuid'=>$row->uuid]).'" class="edit btn btn-primary btn-sm">Ubah</a>';

        $btn = $btn.' <a href="'.route('proyek-drainase.destroy',['uuid'=>$row->uuid]).'" class="btn btn-danger btn-sm hapus">Hapus</a>';

        return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    $data = [
      'title'=>'Proyek Drainase  - TERAS'
    ];

    return view('proyek-drainase.index',$data);

  }

  public function create()
  {
    $data = [
      'title'=>'Tambah Proyek Drainase  - TERAS'
    ];

    return view('proyek-drainase.create',$data);
  }

  public function store(Request $r)
  {

    $drainase = DrainaseProyek::updateOrCreate(['uuid' => $r->uuid],
    [
      'uuid' => (string)Str::uuid(),
      'nama_ruas' => $r->nama_ruas,
      'panjang' => $r->panjang,
      'jenis_pekerjaan' => $r->jenis_pekerjaan,
      'anggaran' => $r->anggaran,
      'tanggal' => $r->tanggal,
    ]);

    return redirect()->route('proyek-drainase.index')->with('message','Data Berhasil Disimpan');
  }

  public function edit($uuid)
  {

    $drainase = DrainaseProyek::where('uuid',$uuid)->first();

    $data = [
      'title'=>'Ubah Proyek Drainase  - TERAS',
      'data'=>$drainase
    ];

    return view('proyek-drainase.edit',$data);
  }

  public function destroy($uuid)
  {
    $drainase = DrainaseProyek::where('uuid',$uuid)->first();
    $drainase->delete();

    return redirect()->route('proyek-drainase.index')->with('message','Data Berhasil Dihapus');
  }

  public function printAll()
  {
    $drainase = DrainaseProyek::all();

    $pdf = PDF::loadView('proyek-drainase.print-all',[
      'title'=>'Proyek Drainase',
      'data'=>$drainase
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'landscape')->stream('Proyek Drainase');
  }
}
