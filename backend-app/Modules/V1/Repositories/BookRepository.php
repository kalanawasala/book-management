<?php
namespace Modules\V1\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use DB;


class BookRepository extends BaseRepository {

    function model() {
        return "Modules\\V1\\Entities\\Book";
    }

    public function __construct() {}

    public function createBook($title)
    {
        DB::table('books')->insert(['title' => $title]);
    }

    public function listBooks() {
        return DB::table('books')
                    ->select(['id', 'title'])
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }
}