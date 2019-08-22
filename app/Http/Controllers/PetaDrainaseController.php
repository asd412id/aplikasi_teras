<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\DrainaseFile;
use Str;
use Validator;
use Storage;
use PDF;

class PetaDrainaseController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index(Request $r)
  {

    $peta = DrainaseFile::where('tipe','peta')
    ->when($r->cari,function($q,$role){
      $q->where('nama','like','%'.$role.'%')
      ->orWhere('deskripsi','like','%'.$role.'%');
    })
    ->get();

    $data = [
      'title'=>'Peta Drainase  - TERAS',
      'peta'=>$peta
    ];

    return view('peta-drainase.index',$data);

  }

  public function create()
  {
    $data = [
      'title'=>'Tambah Peta Drainase  - TERAS'
    ];

    return view('peta-drainase.create',$data);
  }

  public function store(Request $r)
  {

    if ($r->has('uuid')) {
      $dr = DrainaseFile::where('uuid',$r->uuid)->first();
      $filepath = $dr->path;
      if ($r->hasFile('file_peta')) {
        $peta = $r->file('file_peta');
        $allowed_ext = ['jpg','jpeg','png'];
        $peta_ext = $peta->getClientOriginalExtension();

        if ($peta->getSize() > (2048*1000)) {
          return redirect()->back()->withErrors('Ukuran File peta tidak boleh lebih dari 2MB')->withInput();
        }elseif (!in_array(strtolower($peta_ext),$allowed_ext)) {
          return redirect()->back()->withErrors('File peta harus berekstensi jpg, jpeg, atau png')->withInput();
        }

        Storage::delete($dr->path);
        $filepath = $peta->store('drainase_peta');
      }
    }else {
      if ($r->hasFile('file_peta')) {
        $peta = $r->file('file_peta');
        $allowed_ext = ['jpg','jpeg','png'];

        $peta_ext = $peta->getClientOriginalExtension();

        if ($peta->getSize() > (2048*1000)) {
          return redirect()->back()->withErrors('Ukuran File peta tidak boleh lebih dari 2MB')->withInput();
        }elseif (!in_array(strtolower($peta_ext),$allowed_ext)) {
          return redirect()->back()->withErrors('File peta harus berekstensi jpg, jpeg, atau png')->withInput();
        }
      }else {
        return redirect()->back()->withErrors('File peta harus diupload')->withInput();
      }
      $filepath = $peta->store('drainase_peta');
    }


    $drainase = DrainaseFile::updateOrCreate(['uuid' => $r->uuid],
    [
      'uuid' => (string)Str::uuid(),
      'nama' => $r->nama,
      'deskripsi' => $r->deskripsi,
      'tipe' => 'peta',
      'path' => $filepath
    ]);

    return redirect()->route('peta-drainase.index')->with('message','Data Berhasil Disimpan');
  }

  public function edit($uuid)
  {

    $drainase = DrainaseFile::where('uuid',$uuid)->where('tipe','peta')->first();

    $data = [
      'title'=>'Ubah Peta Drainase  - TERAS',
      'data'=>$drainase
    ];

    return view('peta-drainase.edit',$data);
  }

  public function destroy($uuid)
  {
    $drainase = DrainaseFile::where('uuid',$uuid)->first();
    Storage::delete($drainase->path);
    $drainase->delete();

    return redirect()->route('peta-drainase.index')->with('message','Data Berhasil Dihapus');
  }

}
