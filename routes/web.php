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

/**
 * View All Jails
 */
Route::get('/jails',function(){
    return view('jails',[
        'jails' => \App\Models\Jail::all()
    ]);
});


/**
 * Jail Creation Form
 */
Route::get('/jails/create',function(){
    return view('jails-create');
});


/**
 * Create Jail From Request Input
 */
Route::post('/jails',function(\Illuminate\Http\Request $request){
    $jail = \App\Models\Jail::create([
        'name' => $request->get('name'),
        'city' => $request->get('city'),
        'state' => $request->get('state'),
        'admin_email' => $request->get('admin_email')
    ]);

    return redirect('/');
});

/**
 * View Jail
 */
Route::get('/jails/{id}',function($id){

    /*$orders = \App\Models\Order::where('completed',false)
        ->whereHas('inmate',function($inmate) use($id){
        $inmate->where('jail_id',$id);
    })->get();*/

    return view('jail-details',[
        'jail'=>\App\Models\Jail::find($id),
        /*'orders' => $orders*/
    ]);
});

/**
 * List Inmates
 */
Route::get('/inmates',function(){
    return view('inmates');
});

/**
 * View Inmate
 */
Route::get('/inmates/{id}',function(\App\Models\Inmate $id){
    return view('inmate-details',['inmate'=>$id]);
});

/**
 * Create Inmate Form
 */
Route::get('/jails/{jail}/inmates/create',function(\App\Models\Jail $jail){
    return view('inmate-create',['jail'=>$jail]);
});

/**
 * Create Jail Inmate
 */
Route::post('/jails/{jail}/inmates',function(\App\Models\Jail $jail, \Illuminate\Http\Request $request){
    $jail->inmates()->create($request->all());
    return redirect('/jails/'.$jail->id);
});

/**
 * View Order
 */
Route::get('/orders/{order}',function(\App\Models\Order $order){
    return view('order-details',['order'=>$order]);
});

/**
 * Complete Order
 */
Route::get('/orders/{order}/complete',function(\App\Models\Order $order){
    $order->completed = true;
    $order->save();

    return redirect('/inmates/'.$order->inmate->id);
});

/**
 * Create Inmate Order
 */
Route::get('/inmates/{inmate}/orders/create',function(\App\Models\Inmate $inmate){
    $inmate->orders()->create([
        'completed' => false
    ]);
    return redirect('/inmates/' . $inmate->id);
});

/**
 * Create Order Form
 */
Route::get('/orders/{order}/items/create',function(\App\Models\Order $order){
    return view('order-item-create',['order'=>$order]);
});

/**
 * Add Item To Order
 */
Route::post('/orders/{order}/items',function(\App\Models\Order $order,\Illuminate\Http\Request $request){
    $order->items()->attach($request->get('item'));
    return redirect('/orders/' . $order->id);
});

/**
 * List Inventory Items
 */
Route::get('/inventory',function(){
    return view('inventory');
});

/**
 * Create Inventory Item
 */
Route::post('/inventory',function(\Illuminate\Http\Request $request){
    \App\Models\Item::create($request->all());
    return redirect('/inventory');
});

/**
 * Inventory Creation Form
 */
Route::get('/inventory/create',function(){
    return view('inventory-create');
});

/**
 * DB Seeder
 */
Route::get('/demo/seeder',function(){

    //$items = \App\Models\Item::factory()->count(12)->create();

    \App\Models\Jail::factory()
        ->has(\App\Models\Inmate::factory()
            /*->has(\App\Models\Order::factory()
                ->count(2)
            )*/
            ->count(3)
        )
        ->count(5)
        ->create();

    /*\App\Models\Order::all()->each(function(\App\Models\Order $order) use ($items){
        for($x = 0; $x < rand(1,5); $x++) {
            $order->items()->attach($items->random());
        }
    });*/

    return redirect('/');

});

Route::get('/report',function(){

    //Pagination
    //\App\Models\Inmate::paginate(2)->dd(); //report && //report?page=2

    //All inmates
    //\App\Models\Inmate::all()->dd();

    //All inmates ordered by first name
    //\App\Models\Inmate::orderBy('first_name','desc')->get()->dd();

    //Get all inmates whose first name is "Jeff"
    //\App\Models\Inmate::where('first_name','Jeff')->get()->dd();

    //Rename all Jeffs to John (Ugly)
    /*$jeff = \App\Models\Inmate::where('first_name','Jeff');
    $jeff->each(function($j){
        $j->first_name = 'John';
        $j->save();
    });*/

    //Rename all Johns to Jeff (cleaner))
    //$john = \App\Models\Inmate::where('first_name','John')->update(['first_name'=>'Jeff']);

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
    /*dd(\App\Models\Inmate::with('orders.items')->whereHas('orders.items',function($query){
        $query->where('name','Popcorn');
    })->get());*/

    //All inmates, but only attach orders that match the criteria
    /*dd(\App\Models\Inmate::with(['orders' => function($order){
        $order->whereHas('items',function($item){
            $item->where('name','Popcorn');
        });
    }])->get());*/

    /*dd(\App\Models\Inmate::with(['orders' => function($order){
        $order->with('items')->whereHas('items',function($item){
            $item->where('name','Popcorn');
        });
    }])
    ->whereHas('orders.items',function($item){
        $item->where('name','Popcorn');
   })->get());*/

});
