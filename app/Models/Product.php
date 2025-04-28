<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'supplier_id',
        'categorie_id',
        'name',
        'image',
        'description',
        'price'
    ];
    
    /**
     * Get the supplier of this product
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the category of this product
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    /**
     * Get the stocks that have this product
     */
    public function stocks()
    {
        return $this->hasOne(Stock::class);
    }

    /**
     * Get the orders that contain this product
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders')
            ->withPivot('quantite_commande', 'prix_vente')
            ->withTimestamps();
    }
}
