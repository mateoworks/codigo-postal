<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory, ApiTrait;

    protected $allowIncluded = ['suburbs', 'state'];
    protected $allowFilter = ['description'];
    protected $allowSort = ['description'];

    public function suburbs()
    {
        return $this->hasMany(Suburb::class, 'id_municipality');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }
}
