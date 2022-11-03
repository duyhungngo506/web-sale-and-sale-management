<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table = "bill_detail";
    protected $fillable = ['quantity','unit_price'];
    
    public function bill()
    {
        return $this->belongsTo(Bill::class,'id_bill','id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }
}