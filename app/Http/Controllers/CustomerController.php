<?php

namespace App\Http\Controllers;
use App\Models\loginDetails;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function customerDataSubmit(Request $req){


        // Check if the username already exists
        $existingUser = loginDetails::where('user_name', $req->user_name)->first();
        if ($existingUser) {
            return back()->withInput()->with('fail', 'Username already taken.');
        }

        // Hash the password
        $hashedPassword = Hash::make($req->password);

        $register = new Customer;
        $register->full_name = $req->full_name;
        $register->address = $req->address;
        $register->mobile = $req->mobile;
        $register->email = $req->email;

       // Check if the request contains files
        if ($req->hasFile('customer_photo')) {
            // Handle file upload
            $photoPaths = [];
            foreach ($req->file('customer_photo') as $photo) {
                $path = $photo->store('customer_photo', 'public');
                $photoPaths[] = $path;
            }
            
            // Save photo paths to the database
            $register->customer_photo = implode('|', $photoPaths);
        } else {
            // No files were uploaded, set customer_photo to null
            $register->customer_photo = '';
        }


        $login = new loginDetails;

        $login->user_name = $req->user_name;
        $login->role = 'customer';
        $login->password=$hashedPassword;
        $login->Is_Active = '1';
       
        
        $validate = $login->save();

        // Retrieve the ID of the inserted record from the LoginDetails table
        $loginId = $login->id;
        $register->c_id = $loginId;     //saving the id to the c_id

        $res = $register->save();
        
        if($validate && $res){
            return redirect()->route('loginPage')->with('success', 'You have registered successfully.');
        } else {
            return back()->with('fail','Something went wrong.');
        }
    }


    public function customerRecordUpdate(Request $req){

        $customerID = $req->input('id');
        $register = Customer::find($customerID);
        if (!$register) {
            return back()->with('fail', 'Registration not found.');
        }
    
        $register->full_name = $req->input('full_name');
        $register->address = $req->input('address');
        $register->mobile = $req->input('mobile');
        $register->email = $req->input('email');

        // Check if the request contains files
        if ($req->hasFile('customer_photo')) {
            $path = $req->file('customer_photo')->store('photos', 'public');
            $register->customer_photo = $path;
        }

        $res = $register->save();
        
        if ($res) {
            session()->flash('success', 'Data updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');      
        }

        return back();
    }
}
