<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Production\Car;
use DateTimeInterface;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product_detail';
    protected $guarded = [''];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
