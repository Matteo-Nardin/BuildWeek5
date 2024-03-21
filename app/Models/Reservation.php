<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public function reservationUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reservationBook(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
