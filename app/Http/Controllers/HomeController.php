<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){

            $roleAs = Auth()->user()->role_as;
            if($roleAs == 1){
                return view('dashboard');
            }
            elseif($roleAs == 0){
                // return view('dashboard');
                return redirect()->route('products');
            }
        }
    }
}
