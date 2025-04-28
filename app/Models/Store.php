<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';

    protected $fillable = [
        'name',
        'address'
    ];

    /**
     * Get the stock this store uses
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /**
     * Get all products available in this store through stock
     */
    public function products()
    {
        return $this->hasManyThrough(Product::class, Stock::class);
    }
}
