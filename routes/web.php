<?php

Route::group(['middleware'=>'guest'], function()
{
  Route::get('/','MainController@index')->name('main');
  Route::get('/login','MainController@login')->name('main.login');
  Route::post('/login-process','MainController@loginProcess')->name('main.login.process');

  Route::get('/buat-usulan','MainController@usulan')->name('main.usulan');
  Route::post('/buat-usulan/store','MainController@usulanStore')->name('main.usulan.store');

  Route::get('/ajaxjalan','MainController@ajaxJalan')->name('main.ajax.jalan');

  Route::resource('proyek','ProyekController');
  Route::get('/proyek-form/cetak','ProyekController@printAll')->name('proyek.print.all');
});

Route::group(['middleware'=>'auth'], function()
{
  Route::get('/profile','MainController@profile')->name('main.profile');
  Route::post('/profile','MainController@profileUpdate')->name('main.profile.update');
  Route::get('/logout','MainController@logout')->name('main.logout');
  Route::get('/dashboard','MainController@dashboard')->name('main.dashboard');

  Route::resource('drainase','DrainaseController',[
    'except'=>['destroy']
  ]);
  Route::resource('peta-drainase','PetaDrainaseController',[
    'except'=>['destroy']
  ]);
  Route::resource('proyek-drainase','ProyekDrainaseController',[
    'except'=>['destroy']
  ]);
  Route::resource('usulan','UsulanController',[
    'except'=>['destroy']
  ]);

  Route::group(['prefix'=>'/drainase-form'], function()
  {
    Route::get('/{uuid}/destroy', 'DrainaseController@destroy')->name('drainase.destroy');
    Route::get('/delete-foto', 'DrainaseController@deleteFoto')->name('drainase.foto.delete');
    Route::get('/{uuid}/cetak', 'DrainaseController@printSingle')->name('drainase.print.single');
    Route::get('/cetak', 'DrainaseController@printAll')->name('drainase.print.all');
  });

  Route::group(['prefix'=>'/peta-drainase-form'], function()
  {
    Route::get('/{uuid}/destroy', 'PetaDrainaseController@destroy')->name('peta-drainase.destroy');
  });

  Route::group(['prefix'=>'/proyek-drainase-form'], function()
  {
    Route::get('/{uuid}/destroy', 'ProyekDrainaseController@destroy')->name('proyek-drainase.destroy');
    Route::get('/cetak', 'ProyekDrainaseController@printAll')->name('proyek-drainase.print.all');
  });
  Route::group(['prefix'=>'/usulan-form'], function()
  {
    Route::get('/{uuid}/destroy', 'UsulanController@destroy')->name('usulan.destroy');
    Route::get('/cetak', 'UsulanController@printAll')->name('usulan.print.all');
  });
});
