<?php

namespace App\Http\Controllers;
use App\Models\Kvalue;

use Illuminate\Http\Request;
use App\Imports\IndustriImport;
use App\Models\DataIndustri2016;
use App\Http\Controllers\Controller;
use App\Models\dataCluster;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class KmeansController extends Controller
{
    public function index(Request $request)
    {
        $random = DataIndustri2016::all();
        $n = 0;
        if($request->kvalue){         
            $data = DataIndustri2016::all();   
            $random = $data->random($request->kvalue);
            $random->all();

            Kvalue::truncate();
            dataCluster::truncate();
            for ($i=0; $i<$request->kvalue; $i++) { 
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

            $i = 0;

            

            foreach ($data as $key => $item) {

                $k_nilai = array();

                foreach ( Kvalue::all() as $key => $item2)
                {
                    $sum = sqrt(
                                    pow(($item2->t2011)-($item->t2011), 2)+
                                    pow(($item2->t2012)-($item->t2012), 2)+
                                    pow(($item2->t2013)-($item->t2013), 2)+
                                    pow(($item2->t2014)-($item->t2014), 2)+
                                    pow(($item2->t2015)-($item->t2015), 2)+
                                    pow(($item2->t2016)-($item->t2016), 2)
                                );  
                    $k_nilai[] = $sum;
                    $i++;
                }

                $k_min = min($k_nilai);
                $index = array_search($k_min, $k_nilai);
                
                for ($i=0; $i < 25; $i++) { 
                    if (empty($k_nilai[$i]))
                    {
                        $k_nilai[$i] = 0;
                    }
                }

                dataCluster::create([
                    'kecamatan' => $item->kecamatan,
                    'c1' => $k_nilai[0],
                    'c2' => $k_nilai[1],
                    'c3' => $k_nilai[2],
                    'c4' => $k_nilai[3],
                    'c5' => $k_nilai[4],
                    'c6' => $k_nilai[5],
                    'c7' => $k_nilai[6],
                    'c8' => $k_nilai[7],
                    'c9' => $k_nilai[8],
                    'c10' => $k_nilai[9],
                    'c11' => $k_nilai[10],
                    'c12' => $k_nilai[11],
                    'c13' => $k_nilai[12],
                    'c14' => $k_nilai[13],
                    'c15' => $k_nilai[14],
                    'c16' => $k_nilai[15],
                    'c17' => $k_nilai[16],
                    'c18' => $k_nilai[17],
                    'c19' => $k_nilai[18],
                    'c20' => $k_nilai[19],
                    'c21' => $k_nilai[20],
                    'c22' => $k_nilai[21],
                    'c23' => $k_nilai[22],
                    'c24' => $k_nilai[23],
                    'c25' => $k_nilai[24],
                    'cluster' => $k_min,
                    'index' => $index+1,

                ]);

            }
            
        }
        return view('Kmeans',[
            'data' => DataIndustri2016::all(),
            'kvalue' => $request->kvalue,
            'dataKv' => Kvalue::all(),
            'cluster' => dataCluster::all(),
            ]);
        
    }

    

    

    public function store(Request $request) 
    {
        Excel::import(new IndustriImport, $request->file('excel'));
        return back();
    }

    
    
    
}

