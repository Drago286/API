<?php

namespace App\Http\Controllers;

use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::where('SAP', 'LIKE', '%' . $request->sap . '%')->get();
        return view('home', compact('users'));
    }
}
