<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitItem extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }


}
