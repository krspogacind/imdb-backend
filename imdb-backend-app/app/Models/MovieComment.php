<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
    ];

    public function user() {
      return $this->belongsTo('App\Models\User');
    }

    public function movie() {
      return $this->belongsTo('App\Models\Movie');
    }
}
