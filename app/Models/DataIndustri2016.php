<?php

namespace App\Models;

use App\Models\Cluster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataIndustri2016 extends Model
{
    use HasFactory;
    
    protected $guarded =[];

    public function clusters()
    {
        return $this->hasMany(Cluster::class);
    }
}
