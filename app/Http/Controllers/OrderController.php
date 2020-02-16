<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::latest()->get();

            return Datatables::of($orders)->with('user')
                ->addColumn('user_name', function($row){
                    return $row->user->name;
                })
                ->addColumn('user_email', function($row){
                    return $row->user->email;
                })
                ->addColumn('action', function($order){ 
                    $btn = '<a href="' . route('orders.edit', $order->id) .'" class="btn btn-primary btn-sm mr-1 btnEdit" name="edit" >Edit</a>';
                    $btn .= '<a data-toggle="modal" href="#modalView" data-id="' . url('orders/'.$order->id.'/show') .'" class="btn btn-success btn-sm mr-1 btnView">View</a>';
                    $btn .= '<button type="button" data-id="'.$order->id.'" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete">Delete</button>';
 
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);  
        }
        
        return view('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'p_id' => 'required',
            'p_name' => 'required',
            'quantity' => 'required',
            'order_id' => 'required'
        ]);

        $order = Order::find($data['order_id']);
        $check = $order->products->find($data['p_id']);

        if ($check != null) {
            $order->products()->updateExistingPivot( 
                $data['p_id'], ['quantity' => $data['quantity'] ]
            );
            return response()->json([
                'success'=> 'updated',
                'p_id' => $data['p_id'],
                'quantity' => $data['quantity']
            ]);

        }

        $order->products()->attach($data['p_id'], ['quantity' => $data['quantity']]);
        return response()->json([
            'success'=> 'added',
            'p_id' => $data['p_id'],
            'p_name' => $data['p_name'],
            'quantity' => $data['quantity']
        ]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //dd($order->products->first()->title);
        $products = Product::all();
        return view('admin.orders.edit', compact('products', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
