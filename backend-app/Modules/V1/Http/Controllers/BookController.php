<?php

namespace Modules\V1\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use Modules\V1\Repositories\BookRepository;
use Illuminate\Contracts\Support\Renderable;
use Modules\V1\Entities\Book;
use Modules\V1\Http\Requests\Book\CreateBookRequest;
use Modules\V1\Http\Requests\Book\UpdateBookRequest;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function listBooks()
    {
        try {
            $books = $this->bookRepository->listBooks();

            return response()->json([
                'success' => true,
                'message' => 'Books listed successfully',
                'data' => $books
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => ['Error occurred while list books.']
            ], 500);
        }
    }
    public function listBook($id)
    {
        try {
            $books = $this->bookRepository->listBook($id);

            return response()->json([
                'success' => true,
                'message' => 'Book Retrieve successfully',
                'data' => $books
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => ['Error occurred while Retrieve books.']
            ], 500);
        }
    }


    public function createBook(CreateBookRequest $request)
    {
        try {
            $this->bookRepository->createBook($request->title);

            return response()->json([
                'success' => true,
                'message' => 'Book created successfully'
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => ['Error occurred while creating book']
            ], 500);
        }
    }
    public function updateBook(UpdateBookRequest $request, $id)
    {
        try {
            $this->bookRepository->updateBook($request->title, $id);
            return response()->json([
                'success' => true,
                'message' => 'Book update successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => ['Error occurred while creating book']
            ], 500);
        }
    }

    public function deleteBook($id)
    {
        try {
            $this->bookRepository->deleteBook($id);
            return response()->json([
                'success' => true,
                'message' => 'Books Deleted successfully',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => ['Error occurred while list books.']
            ], 500);
        }
    }

    // public function searchBook(Request $request)
    // {
    //     $books = $this->bookRepository->searchBook($request->title);
    //     try {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Books Searching successfully',
    //             'data' => $books
    //         ], 200);
    //     } catch (\Exception $e) {

    //         return response()->json([
    //             'success' => false,
    //             'error' => ['Error occurred while list books.']
    //         ], 500);
    //     }
    // }
}
