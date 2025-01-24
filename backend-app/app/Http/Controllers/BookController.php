<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\book;
class BookController extends Controller
{
    public function index(){
        return view('book.index');
    }
    public function register() {
        return view('book.register');
    }

    public function store(Request $request) {
        //route data to view
        //dd($request->all());
        $validatedData = $request->validate([
            'name'=>'bail|required|string',
            'author'=>'required|string',
            'edition'=>'required|numeric',
            'description'=>'nullable',
            'price'=>'required|numeric',
            'created_at'=>'nullable',

        ]);
        
        /*$data = ($request->all());*/
        $newbook = book::create($validatedData);

        return redirect(\route('book.index'))->with('success','');

        


     }
}
