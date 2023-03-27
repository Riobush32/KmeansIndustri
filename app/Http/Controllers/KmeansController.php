<?php

namespace App\Http\Controllers;
use App\Models\Kvalue;

use App\Models\Cluster;
use App\Models\AvgCluster;
use App\Models\dataCluster;
use Illuminate\Http\Request;
use App\Imports\IndustriImport;
use App\Models\DataIndustri2016;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isEmpty;

class KmeansController extends Controller
{
    
    public function index(Request $request)
    {
        $random = DataIndustri2016::all();
        if($request->kvalue){         
            $data = DataIndustri2016::all();   
            $random = $data->random($request->kvalue);
            $random->all();

            // mengkosongkan table 
            Kvalue::truncate();
            Cluster::truncate();

            // memasukkan data random ke dalam table kvalues  

            $this->createKvalue($random, $request->kvalue);

            // proses 
            $value = Kvalue::all();

            $this->proses($data, $value);

            // masukkan nilai rata2 kedalam table data_calusters
            $avg = array();

            
            $loop = 1;
            for ($l=0; $l < $request->kvalue; $l++) { 
                for ($i=0; $i < 6 ; $i++) { 
                    $c = 't201'.$i+1;
                    $avg[$i] = DB::table('data_industri2016s')
                                ->join('clusters', 'data_industri2016s.id', '=', 'clusters.data_industri2016_id')
                                ->select('data_industri2016s.*')
                                ->where('clusters.index', '=', $l+1)
                                ->avg($c);
                }
                
                $this->createKvalue2($avg, $loop);
            }

        }

        $kv = Kvalue::all();

        return view('page.Kmeans',[
            'data' => DataIndustri2016::all(),
            'kvalue' => $request->kvalue,
            'dataKv' => $kv,
            'cluster' => Cluster::all(),
            ]);
        
    }

    //Function Proses perhitungan Euclidean Distance
    public function proses($data, $value){
        $i = 0;

            foreach ($data as $key => $item) {

                $k_nilai = array();

                foreach ( $value as $key => $item2)
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

                $id = $item->id;
                $this->createCluster($k_nilai, $id, $k_min, $index);

            }
    }

    //Function Memasukkan data Kvalue
    public function createKvalue($random, $value)
    {
        for ($i=0; $i<$value; $i++) { 
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

    public function createKvalue2($data, $lp)
    {
        Kvalue::create([
                    'kecamatan' => $lp,
                    't2011'     => $data[0],
                    't2012'     => $data[1],
                    't2013'     => $data[2],
                    't2014'     => $data[3],
                    't2015'     => $data[4],
                    't2016'     => $data[5],
        ]);
    }
    
    

    // function memasukkan data cluster2
    public function createCluster($k_nilai, $data_id, $k_min, $index)
    {
        Cluster::create([
            'data_industri2016_id' => $data_id,
            'c1'        => $k_nilai[0],
            'c2'        => $k_nilai[1],
            'c3'        => $k_nilai[2],
            'c4'        => $k_nilai[3],
            'c5'        => $k_nilai[4],
            'c6'        => $k_nilai[5],
            'c7'        => $k_nilai[6],
            'c8'        => $k_nilai[7],
            'c9'        => $k_nilai[8],
            'c10'       => $k_nilai[9],
            'c11'       => $k_nilai[10],
            'c12'       => $k_nilai[11],
            'c13'       => $k_nilai[12],
            'c14'       => $k_nilai[13],
            'c15'       => $k_nilai[14],
            'c16'       => $k_nilai[15],
            'c17'       => $k_nilai[16],
            'c18'       => $k_nilai[17],
            'c19'       => $k_nilai[18],
            'c20'       => $k_nilai[19],
            'c21'       => $k_nilai[20],
            'c22'       => $k_nilai[21],
            'c23'       => $k_nilai[22],
            'c24'       => $k_nilai[23],
            'c25'       => $k_nilai[24],
            'cluster'   => $k_min,
            'index'     => $index+1,

        ]);
    }

    

    // function penginputan data excel kedalam database 
    public function store(Request $request) 
    {
        Excel::import(new IndustriImport, $request->file('excel'));
        return back();
    }

    
    
    
}

