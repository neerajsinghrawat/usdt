<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class CustomerProductTranslation extends Model
{

    protected $fillable = ['customer_product_id', 'name', 'lang'];

    public function customer_product(){
      return $this->belongsTo(CustomerProduct::class);
    }
}
