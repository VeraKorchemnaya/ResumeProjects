<?php

/*  
Name: Vera Korchemnaya
Description: 
    This is the Eloquent Model for our project.
    We use this model to insert into the database.
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'state', 'population_2000', 'population_2010', 'population_2020'];
}
