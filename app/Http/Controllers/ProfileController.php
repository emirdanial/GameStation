<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	return view('profile.index', compact('user'));
    }

    public function viewOrder(Request $request)
    {
    	$user = Auth::user();

    	if ($request->ajax()) {
            $orders = Order::find($user);
            return Datatables::of($orders)
                ->addColumn('action', function($order){ 
                    $btn = '<a data-toggle="modal" href="#modalView" data-id="' . url('orders/'.$order->id.'/show') .'" class="btn btn-success btn-sm mr-1 btnView">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);  
        }
        
    	return view('profile.order', compact('user'));
    }
}
