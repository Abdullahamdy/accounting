<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'unit', 'item_number', 'serial_number', 'place', 'qut','category_id', 'serial_multi'
    ];
    protected $casts = [
        'unit_id' => 'array',
    ];

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function serial_numbers()
    {
        return $this->hasMany(SerialNumber::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit_item()
    {
        return $this->hasMany(UnitItem::class);
    }
    // public function units(){
    //     return $this->belongsToMany(Unit::class,UnitItem::class);
    // }

    static function unitList($unit = "")
    {
        $array = [
            0 => 'غير محدد',
            1 => 'غم',
            2 =>  'كغم',
            3 =>  'رطل',
        ];

        if (array_key_exists($unit, $array) && $unit != "" || $unit === 0) {
            return !empty($array[$unit]) ? $array[$unit] : $unit;
        } else {
            return $array;
        }
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    
}
