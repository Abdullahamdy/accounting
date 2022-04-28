<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountGuide extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title'
    ];

    public function index_accounts()
    {
        return $this->hasMany(IndexAccount::class);
    }

}
