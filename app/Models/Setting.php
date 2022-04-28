<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company_name', 'company_phone', 'company_email', 'company_address','discount_earned_account_index_id','allowed_discount_account_index_id','customers_account_index_id','salary_account_index_id', 'company_manager', 'company_description','payment_parchasing_account_index_id','payment_selling_account_index_id','inbox_account_index_id'
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function payment_selling_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'payment_selling_account_index_id');
    }
    public function payment_parchasing_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'payment_parchasing_account_index_id');
    }
    public function inbox_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'inbox_account_index_id');
    }
    public function salary_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'salary_account_index_id');
    }
     public function customers_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'customers_account_index_id');
    }
    public function discount_earned_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'discount_earned_account_index_id');
    }
    public function allowed_discount_account_index()
    {
        return $this->belongsTo(IndexAccount::class,'allowed_discount_account_index_id');
    }
}
