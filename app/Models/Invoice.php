<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'invoice_number', 'description', 'invoice_date', 'last_invoice_payment_date', 'invoice_payment_date', 'total_price', 'status', 'type', 'user_id', 'index_account_id','is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function index_account()
    {
        return $this->belongsTo(IndexAccount::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_discounts()
    {
        return $this->hasMany(InvoiceDiscount::class);
    }

    public function arrest_receipts()
    {
        return $this->hasMany(ArrestReceipt::class,'invoice_id');
    }

    static function statusList($status = false)
    {
        $array = [
            0 => 'مدفوعة',
            1 =>  'غير مدفوعة',
        ];

        if ($status === false){
            return $array;
        }

        if (!is_string($status) and $status != false or $status >= 0) {
            return !empty($array[$status]) ? $array[$status] : $status;
        }
        return $array;
    }

    static function typeList($type = false)
    {
        $array = [
            0 => 'بيع',
            1 =>  'شراء',
        ];

        if ($type === false){
            return $array;
        }

        if (!is_string($type) and $type != false or $type >= 0) {
            return !empty($array[$type]) ? $array[$type] : $type;
        }
        return $array;
    }

    public function getDiscountAttribute(){



        $ttt = 0;
        foreach ($this->invoice_discounts as $row2) {
            $ttt = $ttt + $row2->discount_quantity;

        }

        return $ttt;

    }
    public function getTotalAttribute(){
        $tt = 0;

        foreach ($this->invoice_items as $row) {
            if ($this->type == 1) {
                $tt = $tt + ($row->purchasing_price * $row->quantity);



            } else {
                $tt = $tt + ($row->selling_price * $row->quantity);
            }
        }
        return $tt;
    }

    public function getArrestResebtAttribute(){
        $arrestQutity = 0;
        foreach($this->arrest_receipts as $arrest){
            $arrestQutity = $arrestQutity +($arrest->batch_quantity);

        }
        return $arrestQutity;
    }

    public function getInvoiceRemainingAttribute(){


      $remaining =  $this->arrest_receipts->sum('batch_quantity') + $this->invoice_discounts->sum('discount_quantity');

      if($remaining <= 0 and $this->status == 0){

          $this->update(['status' => 1]);
      }
      return $remaining;
    }
}
