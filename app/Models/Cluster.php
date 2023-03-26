<?php

namespace App\Models;

use App\Models\DataIndustri2016;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cluster extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function data_industri2016s()
    {
        return $this->belongsTo(DataIndustri2016::class, 'data_industri2016_id', 'id');
    }
}
