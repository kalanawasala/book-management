<?php

namespace Modules\V1\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\V1\Entities\Book;

class BookRepository extends BaseRepository
{

    function model()
    {
        return "Modules\\V1\\Entities\\Book";
    }

    public function __construct() {}

    public function createBook($title)
    {
        DB::table('books')->insert(['title' => $title]);
    }

    public function listBooks()
    {
        return DB::table('books')
            ->select(['id', 'title'])
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function searchedBook($title)
    {
        $books = DB::table('books')
            ->select(['id', 'title'])
            ->where('title', 'like', "%{$title}%")
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    public function listBook($id)
    {
        return DB::table('books')
            ->select(['id', 'title'])
            ->where('id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function updateBook($title, $id)
    {
        DB::table('books')->where('id', $id)->update(['title' => (string) $title]);
    }
    public function deleteBook($id)
    {
        DB::table('books')->where('id', $id)->delete();
    }
}
