<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','slug','description','expected_results',
        'usage_instructions','time_of_use','shelf_life',
        'incompatible_products','image','recommended_for'
    ];

    public function recommendedByDoctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_product', 'product_id', 'doctor_id');
    }
}
