<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function login()
    {
        $validation = request()->validate([

            'email' => 'required',
            'password' => "required",
        ]);
        if (auth()->attempt($validation)) {
            return "SuccessFully login";
        }
        return redirect(route('admin_dashboard'))->with('warning', 'Invalid Emails OR Password.');
    }
}
