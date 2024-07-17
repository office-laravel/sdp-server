<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return  view('auth.login');
    
        // else if(auth()->user()->Role == "admin") {
        //     return view('admin.index');
        // }
        // else if(auth()->user()->Role == "manager") {
        //     return view('manager.index');
        // }
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if(!auth()->check())
        {
            return view('auth.login');
        }
        else if(auth()->user()->Role == "admin") {
            return view('admin.home');
        }
        else if(auth()->user()->Role == "manager") {
            return view('manager.home');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
