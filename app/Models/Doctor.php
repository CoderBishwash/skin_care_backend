<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
    ];

    /**
     * Recommended products by this doctor
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'doctor_product', 'doctor_id', 'product_id');
    }
}
