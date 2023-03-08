<?php

namespace App\Http\Controllers;
use App\Imports\IndustriImport;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\DataIndustri2016;
use Illuminate\Http\Request;

class KmeansController extends Controller
{
    public function index()
    {
        return view('kmeans',[
            'data' => DataIndustri2016::all(),
        ]);
    }

    public function store(Request $request) 
    {
        Excel::import(new IndustriImport, $request->file('excel'));
        return back();
    }

    

    // public function fileExport() 
    // {
    //     return Excel::download(new IndustriExport, 'users-collection.xlsx');
    // } 
}

