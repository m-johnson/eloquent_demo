<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/jails');
});

Route::get('/jails',function(){
    return view('jails',[
        'jails' => \App\Models\Jail::all()
    ]);
});

Route::get('/jails/create',function(){
    return view('jails-create');
});

Route::post('/jails',function(\Illuminate\Http\Request $request){
    $jail = \App\Models\Jail::create([
        'name' => $request->get('name'),
        'city' => $request->get('city'),
        'state' => $request->get('state'),
        'admin_email' => $request->get('admin_email')
    ]);

    return redirect('/');
});

Route::get('/demo/seeder',function(){
    \App\Models\Jail::factory()->count(5)->create();
});
