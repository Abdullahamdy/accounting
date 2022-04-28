<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'description'
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
