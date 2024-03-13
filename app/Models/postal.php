<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postal extends Model
{
    use HasFactory;

    protected $table = 'postal';

    protected $fillable = [
        'country',
        'state',
        'city',
        'area',
        'postal',
        'status'
    ];
}
