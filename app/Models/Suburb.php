<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    use HasFactory, ApiTrait;

    protected $allowIncluded = ['settlement', 'city', 'municipality'];
    protected $allowFilter = ['description', 'cp'];
    protected $allowSort = ['description', 'cp'];

    public function settlement()
    {
        return $this->belongsTo(Settlement::class, 'id_settlement')->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city')->withDefault();
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'id_municipality')->withDefault();
    }
}
