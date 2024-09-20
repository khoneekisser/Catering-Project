<?php

namespace App\Http\Controllers;
use App\Models\LoginAuthentication;
use App\Models\CustomerFeedback;
use App\Models\Report;
use App\Models\loginDetails;
use App\Models\Registration;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\AddMenu;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //for login of the  customer and the owner

    public function Login(Request $request)
    {
        
        // Validate the login request
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required',
            
        ]);
        
        // Retrieve the user with the given user_name and role
        $user = loginDetails::where('user_name', $request->user_name)
                            
                            ->first();


        if ($user && $user->Is_Active) {
            if (\Hash::check($request->password, $user->password)) {
                if ($user->role == 'customer') {
                    $request->session()->put('loginId', $user->id);
                    return redirect('/customer');
                } elseif ($user->role == 'owner') {
                    $request->session()->put('loginId', $user->id);
                    return redirect('/owner');
                } elseif ($user->role == 'admin') {
                    $request->session()->put('loginId', $user->id);
                    // Redirect to dashboard upon successful login
                    return redirect('/dashboard');
                } else {
                    return back()->with('fail', 'User not found or inactive.');
                }
            } else {
                return back()->with('fail', 'Password does not match.');
            }
        } else {
            return back()->with('fail', 'User not found or inactive.');
        }
    }  

    //for changing the status of the Customer
    public function toggleActive(Request $request, $id) {
        $client = loginDetails::find($id);
        if ($client) {
            $client->Is_Active = $request->input('Is_Active');
            $client->save();
    
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    //admin function dashboard
    public function dashboard(){
        $data = array();
        if(Session::has('loginId')){
            $data = LoginAuthentication::where('id', '=', Session::get('loginId'))->first();
            $owner = loginDetails::where('role','owner')->get();
            $customer = loginDetails::where('role','customer')->get();
            $menu = AddMenu::all();
            // dd($menu);
            $ownerDetails = [];

            // Iterate over each owner to fetch their details
            foreach ($owner as $own) {
                // Fetch details for each owner
                $details = Registration::where('o_id', $own->id)->get();
                // Append details to the ownerDetails array
                $ownerDetails[$own->id] = $details;
            }

            $customerDetails = [];

            // Iterate over each customer to fetch their details
            foreach ($customer as $cus) {
                // Fetch details for each owner
                $details = Customer::where('c_id', $cus->id)->get();
                // Append details to the ownerDetails array
                $customerDetails[$cus->id] = $details;
            }

            $orders = Order::all();
            $orderDetails = OrderItem::all();

            $feedback = CustomerFeedback::all();
            $report = Report::all();
            $loggedId = loginDetails::all();
            // dd($owner, $customer, $ownerDetails, $customerDetails, $orders, $orderDetails);
            // dd($customerDetails, $ownerDetails);
        }
        // dd($customerDetails, $orders);
        return view('dashboard',compact('data','owner', 'customer', 'menu', 'feedback', 'report',
                     'ownerDetails', 'customerDetails', 'orders', 'orderDetails', 'loggedId'));
    }

    //for the customer function
    public function customer(){
        $data = array();
        if(Session::has('loginId')){
            $data = LoginAuthentication::where('id', '=', Session::get('loginId'))->first();

            $customer = Customer::where('c_id','=',$data->id)->first();

            // dd($customer);
            $activeUsers = loginDetails::where('Is_Active', '=', 1)->pluck('id');
            // dd($activeUsers);
            // $caterings = Registration::all();
            $caterings = Registration::whereIn('o_id', $activeUsers)->get();


            //for the logged user id
            $loggedUser = $data->id;

            //for the info of order table of the logged user
            $activeBookingInfo = Order::where('Is_Active', '=', 1)
                                    ->where('cus_id', '=', $loggedUser)
                                    ->get();

            $orderIds[] = '';
            foreach ($activeBookingInfo as $order) {
                    $orderId = $order->id;
                    // Collect these IDs into an array
                    $orderIds[] = $orderId;
                }
            
            if($orderIds != ''){
                $orderInfo = OrderItem::whereIn('order_id',$orderIds)->get();
            }
            

            // dd($activeBookingInfo);
            // dd($caterings);
            $menu = AddMenu::all();

            
            //ectracting the date for checking
            $comparingDate = Order::where('is_available', '=', 1)->get();

            // Extract the dates into an array for comparision
            $restrictedDates = $comparingDate->pluck('b_date')->map(function ($date) {
                $formattedDate = Carbon::parse($date)->toDateString();
                Log::info('Formatted Date: ' . $formattedDate);
                return $formattedDate;
            })->toArray();
            // dd($data);
        }
        return view('customer_dashboard',compact('data','customer', 'restrictedDates',
                     'caterings', 'menu', 'activeBookingInfo', 'orderInfo'));
    }

    //for the owner function
    public function owner(){
        $data = array();
        $branch = null; // Initialize as null
        if(Session::has('loginId')){
            $data = LoginAuthentication::where('id', '=', Session::get('loginId'))->first();
            // $branch = Registration::where('o_id', $data->id)->get();
            
            
            if ($data) {
                $branch = Registration::where('o_id', $data->id)->first(); // Get the first branch             
            }
            $ownerId = $branch->o_id;
            //for the info of order table of the logged user
            $menu = AddMenu::where('status', '=', 1)
                                    ->where('b_id', '=', $ownerId)
                                    ->get();

            // dd($ownerId);
            // for getting all the orders
            $order = Order::where('Is_Active', '=', 1)
                                    ->where('o_id', '=', $ownerId)
                                    ->get();
            // dd($order);
            $orderIds = [];
            foreach ($order as $od) {
                $orderId = $od->id;
                // Collect these IDs into an array
                $orderIds[] = $orderId;
            }

            $orderDetails = OrderItem::whereIn('order_id', $orderIds)->get();

            $currentDate = Carbon::now();

            $userName = loginDetails::where('role', 'customer')->get();
            
            $customerDetails = Customer::all();

            $feedback = CustomerFeedback::where('owner_id', $data->id)->get();

            // dd($customerDetails);

            // dd( $branch);
        }
        return view('owner_dashboard',compact('data','branch', 'menu', 'feedback',
                     'order', 'orderDetails', 'userName', 'currentDate', 'customerDetails'));
    }  



    // function for admin logout
    public function adminLogout(Request $request)
    {
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/');
        }
    }


    public function updatePassword(Request $request){
        // Validate the request
        // Get the current logged-in user from the session
        $userId = $request->session()->get('loginId');
        $user = loginDetails::find($userId);
        // dd($user);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match.');
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    
    }
}
