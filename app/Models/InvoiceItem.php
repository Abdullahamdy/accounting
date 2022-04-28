<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description', 'item_name', 'invoice_id', 'item_id', 'user_id', 'index_account_id', 'purchasing_price','unit_id', 'selling_price', 'quantity'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function index_account()
    {
        return $this->belongsTo(IndexAccount::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function descounts(){
        return $this->hasMany(InvoiceDiscount::class,'invoice_id');
    }
    public function arrest_recepts(){
        return $this->hasMany(ArrestReceipt::class,'invoice_id');
    }

}
