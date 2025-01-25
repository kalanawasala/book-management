<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\book;
use illuminate\view\Middleware\ShareErrorsFromSession;
class BookController extends Controller
{
    public function index(){
        //get data from database
        $books = Book::all();
       // return to view with data using compact
        return view ('book.index',compact('books'));
    }
    public function register() {
        return view('book.register');
    }

    public function store(Request $request) {
        //route data to view
        //dd($request->all());
        // Passing the validated user input to DB
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

        //return to home directory
        return redirect(\route('book.index'))->with('success','');

        


     }
}
