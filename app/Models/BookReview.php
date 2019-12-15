<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{

    protected $fillable = [
        'book_id', 'comments', 'review'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

}
