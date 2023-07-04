<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function viewProducts()
    {
        $products = Product::all();
        return view('Admin.viewproducts',['products'=>$products]);
    }
    public function Users()
    {
        $users = DB::table('users')->where('role',2)->get();
        return view('Admin.userdetails',['users'=>$users]);
    }
    public function Payments()
    {
        $payments = Payment::all();
        return view('Admin.payments',['payments'=>$payments]);
    }
    public function NewSellerRegister()
    {
        $users = DB::table('users')->where('role',0)->get();
        return view('Admin.newsellerregisters',['users'=>$users]);
    }
    public function AddSeller(Request $request){
        $userId = $request->user_id;
        $user = User::find($userId); 
    
        if ($user) {
            $user->role = '3'; 
            $user->save();
        }
    
        return response('success');
    }
    public function RemoveSeller(Request $request)
    {
        $userId = $request->user_id;
        $user = User::destroy($userId);
        return back();
    }
    
}
