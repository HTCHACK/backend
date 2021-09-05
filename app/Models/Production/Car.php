<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Production\Hold;
use App\Models\Production\Product;
use DateTimeInterface;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $guarded = [''];

    public function holds()
    {
        return $this->hasMany(Hold::class,'car_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'car_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
