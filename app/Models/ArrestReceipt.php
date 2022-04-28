<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArrestReceipt extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'invoice_id', 'batch_quantity', 'user_id', 'type'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static function typeList($type = false)
    {
        $array = [
            0 => 'صادرة',
            1 => 'واردة',
        ];

        if ($type === false){
            return $array;
        }

        if (!is_string($type) and $type != false or $type >= 0) {
            return !empty($array[$type]) ? $array[$type] : $type;
        }
        return $array;

//        $array = [
//            0 => 'صادرة',
//            1 =>  'واردة',
//        ];
//
//        if (array_key_exists($type, $array) && $type != "" || $type === 0) {
//            return !empty($array[$type]) ? $array[$type] : $type;
//        } else {
//            return $array;
//        }
    }
}
