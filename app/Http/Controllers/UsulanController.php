<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\DrainaseUsulan;
use DataTables;
use Str;
use Validator;
use Storage;
use PDF;

class UsulanController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index()
  {

    if (request()->ajax()) {
      $data = DrainaseUsulan::latest()->get();
      return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('tgl',function($row){
        $tgl = date('d/m/Y',strtotime($row->created_at));
        return $tgl;
      })
      ->addColumn('sts',function($row){
        switch ($row->status) {
          case 'diproses':
            $label = 'bg-warning';
            break;
          case 'terlaksana':
            $label = 'bg-success';
            break;

          default:
            $label = 'bg-danger';
            break;
        }
        $dt = '<span class="label '.$label.'">'.ucwords($row->status).'</span>';
        return $dt;
      })
      ->addColumn('action', function($p){

        $btn = $p->foto?'<a data-fancybox="gallery" data-caption="'.nl2br('<h5>'.$p->nama_jalan.'</h5>'.$p->deskripsi).'" href="'.asset('storage/app/'.$p->foto).'" class="btn btn-sm btn-success">Lihat Foto
        </a> ':'';

        $btn = $btn.'<a href="'.route('usulan.edit',['uuid'=>$p->uuid]).'" class="edit btn btn-primary btn-sm">Ubah</a>';

        $btn = $btn.' <a href="'.route('usulan.destroy',['uuid'=>$p->uuid]).'" class="btn btn-danger btn-sm hapus">Hapus</a>';

        return $btn;
      })
      ->rawColumns(['sts','action'])
      ->make(true);
    }

    $data = [
      'title'=>'Usulan  - TERAS'
    ];

    return view('usulan.index',$data);

  }

  public function store(Request $r)
  {

    $usulan = DrainaseUsulan::where('uuid',$r->uuid)->update([
      'status' => $r->status
    ]);

    return redirect()->route('usulan.index')->with('message','Data Berhasil Disimpan');
  }

  public function edit($uuid)
  {

    $usulan = DrainaseUsulan::where('uuid',$uuid)->first();

    $data = [
      'title'=>'Update Usulan  - TERAS',
      'data'=>$usulan
    ];

    return view('usulan.edit',$data);
  }

  public function destroy($uuid)
  {
    $usulan = DrainaseUsulan::where('uuid',$uuid)->first();
    Storage::delete($usulan->foto);
    $usulan->delete();

    return redirect()->route('usulan.index')->with('message','Data Berhasil Dihapus');
  }

  public function printAll()
  {
    $usulan = DrainaseUsulan::orderBy('created_at','desc')->get();

    $pdf = PDF::loadView('usulan.print-all',[
      'title'=>'Daftar Usulan',
      'data'=>$usulan
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'landscape')->stream('Daftar Usulan');
  }
}
