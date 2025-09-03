<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkinType extends Model
{
    protected $table = 'skin_types';
    protected $fillable = ['name', 'description', 'image'];
}
