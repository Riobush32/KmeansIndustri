<?php

namespace App\Imports;

use App\Models\DataIndustri2016;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndustriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    

    public function model(array $row)
    {
        return new DataIndustri2016([
            'kecamatan' => $row['kecamatan'],
            't2011'     => $row['2011'],
            't2012'     => $row['2012'],
            't2013'     => $row['2013'],
            't2014'     => $row['2014'],
            't2015'     => $row['2015'],
            't2016'     => $row['2016'],
        ]);
    }
    
    public function headingRow(): int
    {
        return 1;
    }
    
}
