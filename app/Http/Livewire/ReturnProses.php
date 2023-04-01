<?php

namespace App\Http\Livewire;

use App\Models\Kvalue;
use App\Models\Cluster;
use Livewire\Component;
use GuzzleHttp\Psr7\Request;
use App\Models\DataIndustri2016;

class ReturnProses extends Component
{

    public function render($count, $kvalue, $data)
    {
            $start = 0;
            $loop = 1;
                
                $chek = array();
                for ($i=$start; $i < $count; $i++) { 
                    $dataCluster = Cluster::find($i+1);
                    $dataClusterIterasi = Cluster::find($i+($count*$loop)+1);
                    if ($dataCluster->index == $dataClusterIterasi->index) {
                        $chek[$i] = 1;
                    }
                    else{
                        $chek[$i] = 0;
                    }
                
                }

                if (in_array(0, $chek)) {
                    $centoroid = Kvalue::all()->skip($kvalue*($loop+1))->take($kvalue);
                    $this->kMeans($data, $centoroid, $kvalue, $loop+2);
                }
            $hasil_check = 0;
            if (in_array(0, $chek)) {
                $hasil_check = 0;
            } else {
                $hasil_check = 1;
            }
        return view('livewire.return-proses', [
            'data' => DataIndustri2016::all(),
            'kvalue' => $kvalue,
            'dataKv' => Kvalue::all(),
            'cluster' => Cluster::all(),
            'count' => $count,
            'hasilCeck' => $hasil_check,
        ]);
    }
}
