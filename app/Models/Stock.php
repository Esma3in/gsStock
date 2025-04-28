<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'name_entropot',
        'addresse_entropot'
    ];
    
    /**
     * Get the product in this stock
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the stores that use this stock
     */
    public function stores()
    {
        return $this->belongsTo(Store::class);
    }
}
