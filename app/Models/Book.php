<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'isbn', 'description'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
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
