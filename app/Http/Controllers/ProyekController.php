<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\DrainaseProyek;
use DataTables;
use PDF;

class ProyekController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index(Request $r)
  {
    if (request()->ajax()) {
      if ($r->tahun!='all') {
        $data = DrainaseProyek::whereYear('tanggal',$r->tahun);
      }else{
        $data = DrainaseProyek::latest();
      }
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
      ->make(true);
    }

    $title = $r->tahun!='all'?'Proyek Drainase Tahun '.$r->tahun.'  - TERAS':'Proyek Drainase - TERAS';

    $data = [
      'title'=>$title
    ];

    return view('lihat-proyek',$data);

  }

  public function printAll(Request $r)
  {
    if ($r->tahun!='all') {
      $proyek = DrainaseProyek::whereYear('tanggal',$r->tahun)->orderBy('tanggal','desc')->get();
    }else{
      $proyek = DrainaseProyek::orderBy('tanggal','desc')->get();
    }

    $title = $r->tahun!='all'?'Proyek Drainase Tahun '.$r->tahun:'Proyek Drainase';

    $pdf = PDF::loadView('print-proyek',[
      'title'=>$title,
      'data'=>$proyek
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'landscape')->stream($title);
  }
}
