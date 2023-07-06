<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory, ApiTrait;

    protected $allowIncluded = ['municipalities'];
    protected $allowFilter = ['name'];
    protected $allowSort = ['name'];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'id_state');
    }
}
