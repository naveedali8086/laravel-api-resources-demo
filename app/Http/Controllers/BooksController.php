<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{

    public function store(PostBookRequest $request)
    {

        $book = DB::transaction(function () use ($request) {

            $book = Book::create($request->all());

            $authors = array_map(function ($author_id) use ($book) {

                return ['book_id' => $book->id, 'author_id' => $author_id];

            }, $request->get('authors'));

            DB::table('book_author')->insert($authors);

            return $book;

        });


        return new BookResource($book);
    }


    public function edit(PostBookRequest $request, $id)
    {

        $book = Book::findOrFail($id);

        $authors = array_map(function ($author_id) use ($book) {

            return ['book_id' => $book->id, 'author_id' => $author_id];

        }, $request->get('authors'));


        $updated_book = DB::transaction(function () use ($request, $book, $authors) {

            $book->fill($request->all())->save();

            // inserting only new records and ignoring existing ones
            DB::table('book_author')->insertOrIgnore($authors);

            // deleting records that were added in previous request but are not part of the current request
            DB::table('book_author')
                ->where('book_id', '=', $book->id)
                ->whereNotIn('author_id', $request->get('authors'))
                ->delete();

            return $book;

        });


        return new BookResource($updated_book);
    }

}
