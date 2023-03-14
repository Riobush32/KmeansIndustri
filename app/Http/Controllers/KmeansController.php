<?php

namespace App\Http\Controllers;
use App\Models\Kvalue;

use Illuminate\Http\Request;
use App\Imports\IndustriImport;
use App\Models\DataIndustri2016;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class KmeansController extends Controller
{
    public function index(Request $request)
    {
        $random = DataIndustri2016::all();

        if($request->kvalue){         
            $data = DataIndustri2016::all();   
            $random = $data->random($request->kvalue);
            $random->all();

            Kvalue::truncate();
            for ($i=0; $i <$request->kvalue; $i++) { 
                    Kvalue::create([
                    'kecamatan' => $random[$i]->kecamatan,
                    't2011' => $random[$i]->t2011,
                    't2012' => $random[$i]->t2012,
                    't2013' => $random[$i]->t2013,
                    't2014' => $random[$i]->t2014,
                    't2015' => $random[$i]->t2015,
                    't2016' => $random[$i]->t2016,
                ]);
            }
            
        }
        

        return view('Kmeans',[
            'data' => DataIndustri2016::all(),
            'kvalue' => $request->kvalue,
            'dataKv' => Kvalue::all(),
        ]);

    }

    public function store(Request $request) 
    {
        Excel::import(new IndustriImport, $request->file('excel'));
        return back();
    }

    
    
    
}

