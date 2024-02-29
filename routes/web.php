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

Route::get('/jails/{id}',function($id){

    $orders = \App\Models\Order::where('completed',false)
        ->whereHas('inmate',function($inmate) use($id){
        $inmate->where('jail_id',$id);
    })->get();

    //$orders = \App\Models\Order::whereRelation('inmate','jail_id',$id)->get();

    return view('jail-details',['jail'=>\App\Models\Jail::find($id),
        'orders' => $orders]);
});

Route::get('/inmates',function(){
    return view('inmates');
});

Route::get('/jails/{jail}/inmates/create',function(\App\Models\Jail $jail){
    return view('inmate-create',['jail'=>$jail]);
});

Route::get('/inmates/{id}',function(\App\Models\Inmate $id){
    return view('inmate-details',['inmate'=>$id]);
});

Route::post('/jails/{jail}/inmates',function(\App\Models\Jail $jail, \Illuminate\Http\Request $request){
    $jail->inmates()->create($request->all());
    return redirect('/jails/'.$jail->id);
});

Route::get('/orders/{order}',function(\App\Models\Order $order){
    return view('order-details',['order'=>$order]);
});

Route::get('/orders/{order}/complete',function(\App\Models\Order $order){
    $order->completed = true;
    $order->save();

    return redirect('/inmates/'.$order->inmate->id);
});

Route::get('/orders/{order}/items/create',function(\App\Models\Order $order){
    return view('order-item-create',['order'=>$order]);
});

Route::post('/orders/{order}/items',function(\App\Models\Order $order,\Illuminate\Http\Request $request){
    $order->items()->attach($request->get('item'));
    return redirect('/orders/' . $order->id);
});

Route::get('/inmates/{inmate}/orders/create',function(\App\Models\Inmate $inmate){
    $inmate->orders()->create([
        'completed' => false
    ]);
    return redirect('/inmates/' . $inmate->id);
});

Route::get('/inventory',function(){
    return view('inventory');
});

Route::post('/inventory',function(\Illuminate\Http\Request $request){
    \App\Models\Item::create($request->all());
    return redirect('/inventory');
});

Route::get('/inventory/create',function(){
    return view('inventory-create');
});

Route::get('/demo/seeder',function(){

    $items = \App\Models\Item::factory()->count(12)->create();

    \App\Models\Jail::factory()
        ->has(\App\Models\Inmate::factory()
            ->has(\App\Models\Order::factory()
                ->count(2)
            )
            ->count(3)
        )
        ->count(5)
        ->create();

    \App\Models\Order::all()->each(function(\App\Models\Order $order) use ($items){
        for($x = 0; $x < rand(1,5); $x++) {
            $order->items()->attach($items->random());
        }
    });

});

Route::get('/report',function(){
    //$orders = \App\Models\Order::whereHas();
});
