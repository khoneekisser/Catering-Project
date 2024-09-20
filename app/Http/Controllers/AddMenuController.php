<?php

namespace App\Http\Controllers;
use App\Models\AddMenu;
use App\Models\Customer;
use App\Models\Report;
use App\Models\CustomerFeedback;
use Illuminate\Http\Request;
use App\Models\Registration;

class AddMenuController extends Controller
{
    public function addMenu(Request $req,  $id){

        $req->validate([
            'item_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'available' => 'required',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $path = $req->file('picture')->store('picture', 'public');

        // Save photo paths to the database
        // $register->picture = $photoPaths->implode('|');

        $data = [
            'b_id' => $id,
            'item_name' => $req->item_name,
            'category' => $req->category,
            'price' => $req->price,
            'available' => $req->available,
            'description' => $req->description,
            'picture' => $path,
        ];
        
        // $register = new AddMenu;
        // $register->b_id = $req->id;
        // $register->item_name = $req->item_name;
        // $register->category = $req->category;
        // $register->price = $req->price;
        // $register->available = $req->available;
        // $register->description = $req->description;


        $res = AddMenu::create($data);
      
        // $res = $register->save();
        
        
        if ($res) {
            session()->flash('success', 'Data added successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        
        return back();    
    }


    // for adding the qr photo

    public function addQR(Request $req,  $id){

        $data = $id;
        $rec = Registration::where('o_id', $data)->first();
        if ($req->hasFile('qr_photo')) {
            $rec->qr_photo = $req->file('qr_photo')->store('picture', 'public');
        }
        $rec->save();
        if ($rec) {
            session()->flash('success', 'Data updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        
        return back();   
        
    }

    // for adding the profile photo of customer

    public function addPP(Request $req,  $id){

        $data = $id;
        $rec = Customer::where('id', $data)->first();
        if ($req->hasFile('customer_photo')) {
            $rec->customer_photo = $req->file('customer_photo')->store('picture', 'public');
        }
        $rec->save();
        if ($rec) {
            session()->flash('success', 'Data updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        
        return back();   
        
    }


    //for editing the menu data by the owner
    public  function editMenu(Request $request){

        $menu_id = $request->input('menu-id');
        $menu = AddMenu::find($menu_id);
        $menu->item_name = $request->input('item_name');
        $menu->category = $request->input('category');
        $menu->price = $request->input('price');
        $menu->description = $request->input('description');
        $menu->available = $request->input('available');

        // Handle file upload
        if ($request->hasFile('picture')) {
            $menu->picture = $request->file('picture')->store('picture', 'public');
        }
        
        $menu->save();

        if ($menu) {
            session()->flash('success', 'Data updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        
        return back();   
    }

    // for deleting menu data
    public function deleteOrder($id){
        $order = AddMenu::find($id);

        if (!$order) {
            // Order not found, handle error (you can customize this part based on your application logic)
            return back()->with('error', 'No record found.');
        }
        
        // Update the Is_Active column to 0
        $order->is_available = 0;
        
        // Only save if the attribute has actually changed
        if ($order->isDirty('status')) {
            $order->save();

            // Check if the update was successful
            if ($order->wasChanged('status')) {
                // Update successful, flash success message
                return back()->with('success', 'Order has been deleted successfully!');
            } else {
                // Update failed, flash error message
                return back()->with('error', 'Failed to delete order. Please try again.');
            }
        } else {
            // No changes made
            return back()->with('error', 'No changes were made to the menu.');
        }
    }


    // admin add menu
    public function adminAddMenu(Request $req){

        $req->validate([
            'b_id' => 'required',
            'item_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'available' => 'required',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $path = $req->file('picture')->store('picture', 'public');

        // Save photo paths to the database
        // $register->picture = $photoPaths->implode('|');

        $data = [
            'b_id' => $req->b_id,
            'item_name' => $req->item_name,
            'category' => $req->category,
            'price' => $req->price,
            'available' => $req->available,
            'description' => $req->description,
            'picture' => $path,
        ];


        $res = AddMenu::create($data);
      
        // $res = $register->save();
        
        
        if ($res) {
            session()->flash('success', 'Data added successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        
        return back();    
    }

    // admin edit menu function
    public  function adminEditMenu(Request $request){

        $menu_id = $request->input('id');
        $menu = AddMenu::find($menu_id);
        $menu->item_name = $request->input('item_name');
        $menu->category = $request->input('category');
        $menu->price = $request->input('price');
        $menu->description = $request->input('description');
        $menu->available = $request->input('available');
        $menu->status = $request->input('status');

        // Handle file upload
        if ($request->hasFile('picture')) {
            $menu->picture = $request->file('picture')->store('picture', 'public');
        }
        
        $menu->save();

        if ($menu) {
            session()->flash('success', 'Data updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        
        return back();   
    }

    public function customerFeedback(Request $req){

        $register = new CustomerFeedback;

        $register->customer_id = $req->customer_id;
        $register->owner_id = $req->owner_id;
        $register->order_number = $req->order_number;
        $register->feedback = $req->feedback;

        // Check if the order number already exists
        $existingFeedback = CustomerFeedback::where('order_number', $req->order_number)->first();

        if ($existingFeedback) {
            return back()->with('error', 'Feedback for this order has already been submitted.');
        } else {
            $validate = $register->save();
            
            if ($validate) {
                return back()->with('success', 'Thank you for the feedback.');
            } else {
                return back()->with('error', 'Something went wrong.');
            }
        }
    }


    public function customerFeedbackUpdate(Request $req){

        $data = $req->order_number;
        $rec = CustomerFeedback::where('order_number', $data)->first();

    
        if (!empty($req->feedback)) {
            $rec->feedback = $req->feedback;

            $rec->save();
            if ($rec) {
                session()->flash('success', 'Data updated successfully.');
            } else {
                session()->flash('error', 'Something went wrong.');
            }
            
            return back(); 
            
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        return back(); 
    }
    

    public function userReportSubmit(Request $req){
        // Get the latest report by the user
        $latestReport = Report::where('user_id', $req->user_id)
                              ->orderBy('created_at', 'desc')
                              ->first();
    
        // Check if the latest report was submitted within the last 24 hours
        if ($latestReport && $latestReport->created_at->diffInHours(now()) < 24) {
            return back()->with('error', 'You can only submit one report once every 24 hours.');
        }
    
        // Create a new report
        $register = new Report;
        $register->user_id = $req->user_id;
        $register->report = $req->report;
    
        // Save the report
        $validate = $register->save();
    
        // Return appropriate response
        if ($validate) {
            return back()->with('success', 'Your report has been submitted.');
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }
    

}
