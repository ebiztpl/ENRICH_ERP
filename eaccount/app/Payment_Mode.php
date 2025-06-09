<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment_Mode extends Model
{
    use SoftDeletes;
    protected $table = 'payment_mode';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'deleted_at',
        'updated_at',
    ];
}
