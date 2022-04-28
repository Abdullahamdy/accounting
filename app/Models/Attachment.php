<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'path', 'item_id', 'setting_id', 'category_id'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
