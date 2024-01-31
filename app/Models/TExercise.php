<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TExercise extends Model
{
    use HasFactory;
    
    /**
     *  @var string
     */
    protected $connection = 'mysql';
}
