<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DomainsController extends Controller
{
    /**
     * Show the application Home.
     *
     * @return
     */
    public function home()
    {
        $users = User::all();
        return view('welcome', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index($domain)
    {
        $users = User::with('userRoles')->where('domain',$domain)->firstOrFail();

        return view('users.index', compact('users'));
    }
}
