<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return view('book.index');
    }
    public function register() {
        return view('book.register');
    }

    public function store(Request $request) {
        dd($request->all());
    }
}
