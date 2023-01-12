<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the blacklisted companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.home');
    }
}
