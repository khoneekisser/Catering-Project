<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {

        // Store the uploaded image
        $path = $request->file('pay_pic')->store('picture', 'public');
        
        $data = [
            'cus_id' => $request->input('cus_id'),
            'o_id' => $request->input('o_id'),
            'paidAmnt' => $request->input('paidAmnt'),
            'b_date' => $request->input('b_date'),
            'time_from' => $request->input('time_from'),
            'time_to' => $request->input('time_to'),
            'cus_req' => $request->input('cus_req'),
            'grand_total' => $request->input('grand_total'),
            'pay_pic' => $path,
        ];

        $order = Order::create($data);
    
        if($order){
            $orderItemsData = [];
            foreach ($request->input('items') as $item) {
                $orderItemsData[] = [
                    'order_id' => $order->id,
                    'item_name' => $item['name'],
                    'category' => $item['category'],
                    'rate' => $item['rate'],
                    'total' => $item['total'],
                    'quantity' => $item['quantity'],
                ];
            }

            $insertSuccess = OrderItem::insert($orderItemsData);
        } else {
            session()->flash('error', 'Something went wrong.');
        }

        //for the display of message
        if($insertSuccess){
            session()->flash('success', 'Data added successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }   

        return redirect()->back(); 
         
    }

    // for cancelling the order
    public function cancelOrder($id){
        $order = Order::find($id);
    
        if (!$order) {
            // Order not found, handle error (you can customize this part based on your application logic)
            return back()->with('error', 'Order not found.');
        }
    
        if ($order->status == 0){
            return back()->with('error', 'Order has been already cancelled.');
        }
        // Update the status column to 0
        $order->status = 0;
        $order->save();
    
        // Check if the update was successful
        if ($order->wasChanged('status')) {
            // Update successful, flash success message
            return back()->with('success', 'Order canceled successfully!');
        } else {
            // Update failed, flash error message
            return back()->with('error', 'Failed to cancel order. Please try again.');
        }
    }
  

   // for deleting the order
    public function deleteOrder($id) {
        $order = Order::find($id);

        if (!$order) {
            // Order not found, handle error (you can customize this part based on your application logic)
            return back()->with('error', 'No record found.');
        }
        
        // Update the Is_Active column to 0
        $order->Is_Active = 0;
        
        // Only save if the attribute has actually changed
        if ($order->isDirty('Is_Active')) {
            $order->save();

            // Check if the update was successful
            if ($order->wasChanged('Is_Active')) {
                // Update successful, flash success message
                return back()->with('success', 'Order has been deleted successfully!');
            } else {
                // Update failed, flash error message
                return back()->with('error', 'Failed to delete order. Please try again.');
            }
        } else {
            // No changes made
            return back()->with('error', 'No changes were made to the order.');
        }
    }



    // for admin editing the order
    public function adminUpdateOrders(Request $request)
    {

        $order_id = $request->input('id');
        $order = Order::find($order_id);

        if (!$order) {
            session()->flash('error', 'Order not found.');
            return redirect()->back();
        }

        $order->Is_Active = $request->input('Is_Active');
        $order->status = $request->input('status');
        $order->is_available = $request->input('is_available');
        
        $order->save();

        
       

        session()->flash('success', 'Data updated successfully.');
        return redirect()->back(); 
         
    }


    // for completion of order
    public function orderComplete($id){
        $order = Order::find($id);
    
        if (!$order) {
            // Order not found, handle error (you can customize this part based on your application logic)
            return back()->with('error', 'Order not found.');
        }
    
        if ($order->completed == 1){
            return back()->with('error', 'Order has been already cancelled.');
        }
        // Update the status column to 0
        $order->completed = 1;
        $order->save();
    
        // Check if the update was successful
        if ($order->wasChanged('completed')) {
            // Update successful, flash success message
            return back()->with('success', 'The order has been completed successfully!');
        } else {
            // Update failed, flash error message
            return back()->with('error', 'Failed to complete the action. Please try again.');
        }
    }

}

