<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Drainase;
use App\Models\DrainaseFile;
use App\Models\DrainaseProyek;
use App\Models\DrainaseUsulan;

use Validator;
use Auth;
use Str;

class MainController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


  public function index()
  {
    $data = [
      'title'=>'Selamat Datang - TERAS'
    ];
    return view('index',$data);
  }

  public function dashboard()
  {
    $dt['drainase'] = Drainase::count();
    $dt['peta'] = DrainaseFile::where('tipe','peta')->count();
    $dt['proyek'] = DrainaseProyek::count();
    $dt['usulan'] = DrainaseUsulan::count();
    $data = [
      'title'=>'Beranda - TERAS',
      'count'=>$dt
    ];
    return view('dashboard',$data);
  }

  public function login()
  {
    $data = [
      'title'=>'Login - TERAS'
    ];

    return view('login',$data);
  }

  public function loginProcess(Request $r)
  {
    $roles = [
      'username' => 'required',
      'password' => 'required'
    ];

    $messages = [
      'username.required' => 'Username tidak boleh kosong!',
      'password.required' => 'Password tidak boleh kosong!'
    ];

    Validator::make($r->all(),$roles,$messages)->validate();

    if (Auth::attempt([
      'username'=>$r->username,
      'password'=>$r->password,
    ],($r->remember?true:false))) {
      return redirect()->back();
    }

    return redirect()->back()->withErrors(['Username atau password tidak sesuai!'])->withInput($r->only('username','remember'));
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->back();
  }

  public function usulan()
  {
    $data = [
      'title'=>'Buat Usulan - TERAS'
    ];

    return view('buat-usulan',$data);
  }

  public function ajaxJalan(Request $r)
  {
    $jalan = Drainase::where('nama_jalan','like','%'.$r->keyword.'%')->select('nama_jalan')->get();

    if (count($jalan)) {
      ?>
      <ul id="jalan-list">
        <?php
        foreach($jalan as $j) {
          ?>
          <li onClick="selectJalan('<?php echo $j->nama_jalan; ?>');"><?php echo $j->nama_jalan; ?></li>
        <?php } ?>
      </ul>
      <?php
    }
  }

  public function usulanStore(Request $r)
  {
    $roles = [
      'nama_pengusul' => 'required',
      'nama_jalan' => 'required',
      'captcha' => 'required|captcha',
      'telp' => 'numeric'
    ];

    $messages = [
      'nama_pengusul.required' => 'Anda harus memasukkan nama!',
      'nama_jalan.required' => 'Nama jalan tidak boleh kosong!',
      'telp.numeric' => 'Format nomor telepon tidak sesuai!',
      'captcha.required' => 'Captcha harus diisi!',
      'captcha.captcha' => 'Captcha tidak sesuai!'
    ];

    Validator::make($r->all(),$roles,$messages)->validate();

    $cek = Drainase::where('nama_jalan',$r->nama_jalan)->count();
    if (!$cek) {
      return redirect()->back()->withErrors(['Nama jalan tidak ditemukan!'])->withInput($r->only('nama_pengusul','telp','deskripsi'));
    }

    $filepath = null;

    if ($r->hasFile('foto')) {
      $foto = $r->file('foto');
      $allowed_ext = ['jpg','jpeg','png'];

      $foto_ext = $foto->getClientOriginalExtension();

      if ($foto->getSize() > (2048*1000)) {
        return redirect()->back()->withErrors('Ukuran File foto tidak boleh lebih dari 2MB')->withInput($r->only('nama_pengusul','telp','deskripsi'));
      }elseif (!in_array(strtolower($foto_ext),$allowed_ext)) {
        return redirect()->back()->withErrors('File foto harus berekstensi jpg, jpeg, atau png')->withInput($r->only('nama_pengusul','telp','deskripsi'));
      }
      $filepath = $foto->store('drainase_usulan');
    }else{
      return redirect()->back()->withErrors('Anda harus mengirim bukti foto!')->withInput($r->only('nama_pengusul','telp','deskripsi'));
    }


    $insert = DrainaseUsulan::create([
      'uuid' => (string)Str::uuid(),
      'nama_pengusul' => $r->nama_pengusul,
      'telp' => $r->telp,
      'nama_jalan' => $r->nama_jalan,
      'deskripsi' => $r->deskripsi,
      'foto' => $filepath
    ]);

    return redirect()->back()->with('message','Usulan Anda telah dikirim dan akan segera diperiksa!');
  }

  public function profile()
  {
    $data = [
      'title'=>'Data Profil - TERAS',
      'data'=>auth()->user()
    ];

    return view('profile',$data);
  }

  public function profileUpdate(Request $r)
  {
    $roles = [
      'nama' => 'required',
      'username' => 'required',
      'old_password' => 'required'
    ];

    $messages = [
      'nama.required' => 'Nama tidak boleh kosong!',
      'username.required' => 'Username tidak boleh kosong!',
      'old_password.required' => 'Password tidak boleh kosong!'
    ];

    Validator::make($r->all(),$roles,$messages)->validate();

    $cek = auth()->validate(['id'=>auth()->user()->id,'password'=>$r->old_password]);


    if ($cek) {
      $user = User::where('id',auth()->user()->id)
      ->first();
      $user->nama = $r->nama;
      $user->username = $r->username;
      if ($r->new_password!='') {
        $user->password = bcrypt($r->new_password);
      }
      $user->save();
      return redirect()->back()->withMessage('Profil berhasil diubah');
    }

    return redirect()->back()->withErrors(['Password tidak sesuai!']);
  }
}
