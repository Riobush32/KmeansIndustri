<?php

namespace App\Http\Controllers;
use App\Models\Kvalue;

use App\Models\AvgCluster;
use App\Models\dataCluster;
use Illuminate\Http\Request;
use App\Imports\IndustriImport;
use App\Models\DataIndustri2016;
use App\Http\Controllers\Controller;

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
            AvgCluster::truncate();
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

                // Memasukkan data kedalam table data_clusters 

                $kecamatan = $item->kecamatan;
                $this->createCluster($k_nilai, $kecamatan, $k_min, $index);

            }

            // masukkan rata2 


            AvgCluster::create([
                'avg_c1' => dataCluster::avg('c1'),
                'avg_c2' => dataCluster::avg('c2'),
                'avg_c3' => dataCluster::avg('c3'),
                'avg_c4' => dataCluster::avg('c4'),
                'avg_c5' => dataCluster::avg('c5'),
                'avg_c6' => dataCluster::avg('c6'),
                'avg_c7' => dataCluster::avg('c7'),
                'avg_c8' => dataCluster::avg('c8'),
                'avg_c9' => dataCluster::avg('c9'),
                'avg_c10' => dataCluster::avg('c10'),
                'avg_c11' => dataCluster::avg('c11'),
                'avg_c12' => dataCluster::avg('c12'),
                'avg_c13' => dataCluster::avg('c13'),
                'avg_c14' => dataCluster::avg('c14'),
                'avg_c15' => dataCluster::avg('c15'),
                'avg_c16' => dataCluster::avg('c16'),
                'avg_c17' => dataCluster::avg('c17'),
                'avg_c18' => dataCluster::avg('c18'),
                'avg_c19' => dataCluster::avg('c19'),
                'avg_c20' => dataCluster::avg('c20'),
                'avg_c21' => dataCluster::avg('c21'),
                'avg_c22' => dataCluster::avg('c22'),
                'avg_c23' => dataCluster::avg('c23'),
                'avg_c24' => dataCluster::avg('c24'),
                'avg_c25' => dataCluster::avg('c25'),        
            ]);
            
        }

        return view('Kmeans',[
            'data' => DataIndustri2016::all(),
            'kvalue' => $request->kvalue,
            'dataKv' => Kvalue::all(),
            'cluster' => dataCluster::all(),
            ]);
        
    }
    
    
    public function createCluster($k_nilai, $kecamatan, $k_min, $index)
    {
        dataCluster::create([
                    'kecamatan' => $kecamatan,
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

    

    

    public function store(Request $request) 
    {
        Excel::import(new IndustriImport, $request->file('excel'));
        return back();
    }

    
    
    
}

