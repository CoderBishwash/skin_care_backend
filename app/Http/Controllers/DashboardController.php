<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Doctor;


class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $usersCount = User::count();
          $doctorsCount = Doctor::count();


        return view('backend.dashboard', compact('productsCount','usersCount','doctorsCount'));
    }
}
