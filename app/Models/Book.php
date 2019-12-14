<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = [
        'title', 'isbn', 'description'
    ];


    public function authors()
    {

        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id');

    }


    public function reviews()
    {

        return $this->hasMany(BookReview::class, 'book_id', 'id');

    }

}
