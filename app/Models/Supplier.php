<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    /**
     * Get the products supplied by this supplier
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
