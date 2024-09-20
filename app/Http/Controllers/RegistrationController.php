<?php

namespace App\Http\Controllers;
use App\Models\loginDetails;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
     public function ownerdatasubmit(Request $req){
         // Check if the username already exists
         $existingUser = loginDetails::where('user_name', $req->user_name)->first();
         if ($existingUser) {
             return back()->withInput()->with('fail', 'Username already taken.');
         }
         
        // Hash the password
        $hashedPassword = Hash::make($req->password);

       
        $register = new Registration;

        $register->Catering_Name = $req->catering_name;

        $path = $req->file('catering_logo')->store('photos', 'public');
        $register->Logo = $path;
        // $register->Logo = $req->catering_logo;

        $register->latitude = $req->latitude;
        $register->longitude = $req->longitude;
        $register->Provience = $req->address_province;
        $register->District = $req->address_district;
        $register->L_Muncipality = $req->address_municipality;
        $register->Ward = $req->ward_no;
        $register->Pan_no = $req->pan_no;
        $register->Reg_no = $req->reg_no;
        $register->Contact = $req->contact_person;
        $register->Mobile = $req->mobile;
        $register->Email = $req->email;
        $register->Remark = $req->remarks;

        // Handle file upload
        $photoPaths = [];
        foreach ($req->file('pan_no_picture') as $photo) {
            $path = $photo->store('Pan_no_Photo', 'public');
            $photoPaths[] = $path;
        }
        
        // Save photo paths to the database
        $register->Pan_no_Photo = implode('|', $photoPaths);

        // Handle file upload
        $regPhotoPaths = [];
        // Handle file upload
        foreach ($req->file('reg_no_picture') as $photo) {
            $path = $photo->store('Reg_no_Photo', 'public');
            $regPhotoPaths[] = $path;
        }
        
        // Save photo paths to the database
        $register->Reg_no_Photo = implode('|', $regPhotoPaths);


        $login = new loginDetails;

        $login->user_name = $req->user_name;
        $login->role = 'owner';
        $login->password=$hashedPassword;
       
        
        $validate = $login->save();

        // Retrieve the ID of the inserted record from the LoginDetails table
        $loginId = $login->id;
        $register->o_id = $loginId;     //saving the id to the o_id

        $res = $register->save();
        
        if($validate && $res){
            return redirect()->route('loginPage')->with('success','You have registered successfully.');
        } else {
            return back()->with('fail','Something went wrong.');
        }   
    }




    public function ownerRecordUpdate(Request $request)
    {    
        // Find the existing registration record by ID
        $ownerID = $request->input('id');
        $register = Registration::find($ownerID);
        if (!$register) {
            return back()->with('fail', 'Registration not found.');
        }
    
        // Update registration details ->input('item_name')
        $register->Catering_Name = $request->input('Catering_Name');
    
        if ($request->hasFile('catering_logo')) {
            $path = $request->file('catering_logo')->store('photos', 'public');
            $register->Logo = $path;
        }
    
        $register->latitude = $request->input('latitude');
        $register->longitude = $request->input('longitude');
        $register->Provience = $request->input('address_province');
        $register->District = $request->input('address_district');
        $register->L_Muncipality = $request->input('address_municipality');
        $register->Ward = $request->input('ward_no');
        $register->Pan_no = $request->input('Pan_no');
        $register->Reg_no = $request->input('reg_no');
        $register->Contact = $request->input('contact_person');
        $register->Mobile = $request->input('mobile');
        $register->Email = $request->input('email');
        $register->Remark = $request->input('remarks');
    
        // Handle PAN photo upload
        if ($request->hasFile('pan_no_picture')) {
            $photoPaths = [];
            foreach ($request->file('pan_no_picture') as $photo) {
                $path = $photo->store('Pan_no_Photo', 'public');
                $photoPaths[] = $path;
            }
            $register->Pan_no_Photo = implode('|', $photoPaths);
        }
    
        // Handle registration number photo upload
        if ($request->hasFile('reg_no_picture')) {
            $regPhotoPaths = [];
            foreach ($request->file('reg_no_picture') as $photo) {
                $path = $photo->store('Reg_no_Photo', 'public');
                $regPhotoPaths[] = $path;
            }
            $register->Reg_no_Photo = implode('|', $regPhotoPaths);
        }
    
        // Save the updated registration details
        $res = $register->save();
    
        if ($res) {
            session()->flash('success', 'Data updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong.');      
        }

        return back();
    }
    

}
