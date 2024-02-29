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
            ->has(\App\Models\Order::fdraactory()
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
    //Get all inmates who have an open order total over 5 dollars

    //Pagination
    //\App\Models\Inmate::paginate(2)->dd(); //report && //report?page=2

    //All inmates
    //\App\Models\Inmate::all()->dd();

    //All inmates ordered by first name
    //\App\Models\Inmate::orderBy('first_name','desc')->get()->dd();

    //Get all inmates whose first name is "Jeff"
    //\App\Models\Inmate::where('first_name','Jeff')->get()->dd();

    //Get all inventory items where the price is greater than 1.00
    //\App\Models\Item::where('price','>',1)->get()->dd();

    //Simple find
    //dd(\App\Models\Inmate::find(2));

    //Get inmate with relationships
    //dd(\App\Models\Inmate::with('orders.items')->find(1));

    //Get inmates who have ordered Popcorn (Note that this doesn't provide the relationship data)
    /*dd(\App\Models\Inmate::whereHas('orders.items',function($query){
        $query->where('name','Popcorn');
    })->get());*/

    //Same thing but with all orders
    dd(\App\Models\Inmate::with('orders.items')->whereHas('orders.items',function($query){
        $query->where('name','Popcorn');
    })->get());

    //Same thing with only matching relationships
    dd(\App\Models\Inmate::with(['orders' => function($query){
        $query->whereHas('items',function($sub){
            $sub->where('name','Popcorn');
        });
    }]));

});
