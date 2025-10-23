<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function page(){
        return view('orders.create');
    }
        // 'hotel_id',
        // 'dep_id',
        // 'coor_id',
    public function history(){
        $user = Auth::user();
        // dd($user->coor_id);
        $orders = Order::where('hotel_id', $user->hotel_id)->
        where('dep_id', $user->dep_id)->
        where('coor_id', $user->coor_id)->latest()->paginate(14);
        return view('orders.history', compact('orders'));
    }

    public function store(Request $request){
        $data = $request->all(); 
        $user = Auth::user();
      // dd($data);
        $validated = $request ->validate([
            'orders.*.hotel_id'         => 'required|integer',
            'orders.*.dep_id'           => 'required|integer',
            'orders.*.coor_id'          => 'required|integer',
            'orders.*.event_date'       => 'required|date',
            'orders.*.work_start_time'  => 'required|date_format:H:i',
            'orders.*.work_end_time'    => 'required|date_format:H:i',
            'orders.*.workers_number'   => 'required|integer|min:1',
            'orders.*.event_start_time' => 'required|date_format:H:i',
            'orders.*.event_end_time'   => 'required|date_format:H:i',
            'orders.*.guests_number'    => 'required|integer|min:0',
            'orders.*.duty_content'     => 'required|string',
            'orders.*.venue_name'       => 'required|string',
            'orders.*.position'         => 'required|string',
            'orders.*.comments'         => 'nullable|string'
            
            // "event_date"=>["required", "date"],
            // "work_start_time"=>["required", "date_format:H:i"],
            // "work_end_time"=>["required", "date_format:H:i"],
            // "workers_number"=>["required", "integer", "min:1"],
            // "event_start_time"=>["required", "date_format:H:i"],
            // "event_end_time"=>["required", "date_format:H:i"],
            // "guests_number"=>["required", "integer", "min:1"],
            // "duty_content"=>["required", "string"],
            // "venue_name"=>["required", "string"],
            // "position"=>["required", "string"],
            // "comments"=>["nullable", "string"],
            // "hotel_id"=>["required", "integer"],
            // "dep_id"=>["required", "integer"],
            // "coor_id"=>["required", "integer"]
        ]); 
        

        foreach($validated["orders"] as $orderRow){
            Order::create($orderRow); 
        }
        
        
        
        return redirect()->back()->with("success", 'Order is completed!!');
        
    }
    public function update(){
        // this functu¥ion is to update data from db 
        // |integer|min:1
    }
    public function changeOrder($id){
        $order = Order::where('id', $id)->first();
        return view('orders.change', compact('order'));
    }

}
