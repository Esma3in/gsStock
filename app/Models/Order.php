<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'description'
    ];

    /**
     * Get the customer that made this order
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the products in this order
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')
            ->withPivot('quantite_commande', 'prix_vente')
            ->withTimestamps();
    }
}
