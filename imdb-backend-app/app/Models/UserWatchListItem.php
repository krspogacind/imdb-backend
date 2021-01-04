<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWatchListItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'watched',
    ];

    public function user() {
      return $this->belongsTo('App\Models\User');
    }

    public function movie() {
      return $this->belongsTo('App\Models\Movie');
    }
}
