<?php

// Name: Vera Korchemnaya
// Description: Eloquent Model
//      This class is used to create a comic book in the issues table.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'volume', 'issue_number', 'month', 'year', 'condition', 'writer_last_name', 'writer_first_name', 'artist_last_name', 'artist_first_name'];
}
