<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndexAccount extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'account_number', 'account_name', 'index_account_id', 'balance', 'basic', 'account_guide_id'
    ];

    public function parent()
    {
        return $this->belongsTo(IndexAccount::class, 'index_account_id', 'id');
    }

    public function account_guide()
    {
        return $this->belongsTo(AccountGuide::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'index_account_id');
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function index_accounts()
    {
        return $this->hasMany(IndexAccount::class);
    }


    static function basicList($basic = false)
    {
        $array = [
            0 => 'غير محدد',
            1 =>  'فواتير البيع',
            2 =>  'فواتير الشراء',
        ];

        if ($basic === false){
            return $array;
        }

        if (!is_string($basic) and $basic != false or $basic >= 0) {
            return !empty($array[$basic]) ? $array[$basic] : $basic;
        }
        return $array;
    }

    public function getTotalPriceAttribute(){

         $setting =   Setting::find(1);

        if($this->id == $setting->payment_parchasing_account_index_id){
            $purchasingtotal = 0;

          $invoice =  Invoice::where('type',1)->get();

          foreach($invoice as $invoiceitem){
              foreach($invoiceitem->invoice_items as $invoicepur){

                $purchasingtotal = $purchasingtotal + ($invoicepur->unit->purchasing_price * $invoicepur->quantity) ;

            }

            return $purchasingtotal;
          }



        }elseif($this->id == $setting->payment_selling_account_index_id){
            $sellingprice = 0;
            $invoice =  Invoice::where('type',0)->get();
            foreach($invoice as $invoiceitem){

                foreach($invoiceitem->invoice_items as $invoicepur){

                  $sellingprice = $sellingprice + ($invoicepur->unit->selling_price * $invoicepur->quantity) ;

              }

              return $sellingprice;
            }
        }elseif($this->id == $setting->inbox_account_index_id){
           $invoice =  Invoice::where('type',1)->get();
          $batch = 0;
           foreach($invoice as $item){
               foreach($item->arrest_receipts as $itemarrestresept){
                       $batch = $batch + $itemarrestresept->batch_quantity;

               }
               return $batch;
           }

        }elseif($this->id == $setting->salary_account_index_id){
            return 1;

        }elseif($this->id == $setting->customers_account_index_id){
            $totpri = 0 ;
            $invoices =  Invoice::where('type',0)->get();
            foreach($invoices as $invoice){
                foreach($invoice->invoice_items as $invoiceitem){
                    $sellingPrice = $invoiceitem->unit->selling_price;
                    $qutit = $invoiceitem->quantity;
                    $totpri = $totpri + ($sellingPrice * $qutit);


                }

            }

            $invoices =  Invoice::where('type',0)->get();
            $receipts = 0;
             foreach($invoices as $invoice){
                 foreach($invoice->arrest_receipts as $itemarrestresept){
                         $receipts = $receipts + $itemarrestresept->batch_quantity;//المبالغ المقبوضة
                         return $totpri - $receipts;
                        }


             }
        }elseif($this->id == $setting->allowed_discount_account_index_id){

            $descountselling = 0;
            $invoice =  Invoice::where('type',0)->get();

            foreach($invoice as $item){
                foreach($item->invoice_discounts as $discount){
                        $descountselling = $descountselling + $discount->discount_quantity;//المبالغ المقبوضة
                }
            return  $descountselling;

            }
        }elseif($this->id == $setting->discount_earned_account_index_id){
           $descountparching = 0 ;
           $invoice =  Invoice::where('type',1)->get();
           foreach($invoice as $item){
               foreach($item->invoice_discounts as $discount){
                       $descountparching = $descountparching + $discount->discount_quantity;//المبالغ المقبوضة
               }


           }
           return  $descountparching;

        }elseif($this->index_account_id == Null){
            $total_index = 0 ;

            foreach($this->index_accounts as $index){
                $total_index = $total_index + $index->total_price;


            }
            return $total_index;
        }
        return 0;
    }



               /**
                * Get the value of total_index
                */
               public function getTotal_index()
               {
                              return $this->total_index;
               }

               /**
                * Set the value of total_index
                *
                * @return  self
                */
               public function setTotal_index($total_index)
               {
                              $this->total_index = $total_index;

                              return $this;
               }
}
