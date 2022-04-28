<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerialNumber extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title', 'serial', 'item_id', 'status'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    static function statusList($status = "")
    {
        $array = [
            0 => 'مباع',
            1 => 'غير مباع',
        ];

        if ($status === false) {
            return $array;
        }

        if (!is_string($status) and $status != false or $status >= 0) {
            return !empty($array[$status]) ? $array[$status] : $status;
        }
        return $array;
    }
}
