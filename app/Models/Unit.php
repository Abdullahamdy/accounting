<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'pieces','measruing_unit','item_id','selling_price', 'purchasing_price',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
