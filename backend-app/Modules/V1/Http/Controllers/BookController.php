<?php

namespace Modules\V1\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\V1\Repositories\BookRepository;

use Modules\V1\Http\Requests\Book\CreateBookRequest;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->bookRepository = $bookRepository;
    }

    public function listBooks() {
        try {
            $books = $this->bookRepository->listBooks();

            return response()->json([
                'success' => true, 
                'message'=> 'Books listed successfully',
                'data' => $books
            ], 200); 
        } catch (\Exception $e) {

            return response()->json([
                'success' => false, 
                'error'=> ['Error occurred while list books.']
            ], 500);
        }
    }

    public function createBook(CreateBookRequest $request) {
        try {
            $this->bookRepository->createBook($request->title);

            return response()->json([
                'success' => true, 
                'message'=> 'Book created successfully'
            ], 200); 
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false, 
                'error'=> ['Error occurred while creating book']
            ], 500);
        }
    }
}
