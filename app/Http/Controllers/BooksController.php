<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{

    /**
     * Stores the Book resource and returns it
     *
     * @param PostBookRequest $request
     * @return BookResource
     */
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


    /**
     * Updates the Book resource
     *
     * @param PostBookRequest $request
     * @param $id
     * @return BookResource
     */
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


    /**
     * Returns the single Book resource
     *
     * @param $id
     * @return BookResource
     */
    public function getBook($id)
    {
        return new BookResource(Book::findOrFail($id));
    }


    /**
     * Returns Books resource as a collection with pagination
     *
     * @return BookCollection
     */
    public function getBooks()
    {

        /* Adding 'id' as constraint for getting data (obviously other contraints can be added or no constraint at all */
        return new BookCollection(Book::query()
            ->where('id', '>', 2)
            ->paginate(2)
        );

    }

}
