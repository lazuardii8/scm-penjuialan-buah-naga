<?php

namespace App\Http\Controllers;

use App\Peramalan;
use Auth;
use App\User;
use App\Produk;
use App\transaksi;
use App\Pencatatan;
use App\penggunaanBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class PeramalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulans = penggunaanBahanBaku::orderBy('created_at','asc')->get()->groupBy(function($d) {
           return Carbon::parse($d->created_at)->format('m');
       }, 'pencatatan_id');

        $no = 0;
        $data = array();
        $jumlah = 0;
        $perediksiData = array();

        $m = 0;
        $n = 0;

        foreach ($bulans as $bulan => $counts) {
            // echo $bulan;
            foreach ($counts as $count) {
                 // echo $count;
                $jumlah += $count->jumlah_akhir;

                $created_at = Carbon::parse($count->created_at)->format('m');
            }

            $prolehan =  array (
                'jumlah' => $jumlah,
                'bulan' => $created_at,
            );

            array_push($data, $prolehan);

            $jumlah = 0;
        }

        // dd($data);

        $a = 0.5;
        $xt = $data[0]['jumlah'];
        $s1lalu = 0;
        $s2lalu = 0;
        $priode = 0;

        for ($i=0; $i <= count($data) ; $i++) { 

            if ($i == 0) {
                $s1 = $data[0]['jumlah'];
                $s2 = $data[0]['jumlah'];
            } else {
                $s1 = ($a * $xt) + ((1-$a) * $s1lalu);
                $s2 = ($a * $s1) + ((1-$a) * $s2lalu);
            }


            $nilaiA = (2 * $s1) - $s2;
            $nilaiB = ($a / (1-$a)) * ($s1-$s2) ;

            $prediksi = $nilaiA + $nilaiB;

            // $bulandata = $data[$i]['bulan']+1;
            
            if (empty($data[$i]['jumlah'])) {
                $newdata =  array (
                    'jumlah_akhir' => 'null',
                    'prediksi' => $prediksi,
                    'bulan' => (int)$bulandata,
                );
            } else {
                $newdata =  array (
                    'jumlah_akhir' => $data[$i]['jumlah'],
                    'prediksi' => $prediksi,
                    'bulan' => (int)$data[$i]['bulan'],
                );

                $bulandata = $data[$i]['bulan']+1;
            }


            array_push($perediksiData, $newdata);

            if (!empty($data[$i]['jumlah'])) {
                $xt = $data[$i]['jumlah'];
                $s1lalu = $s1;
                $s2lalu = $s2;
            }

        }

        $dataPresiksis = $object = json_decode(json_encode($perediksiData), FALSE);

        // dd($dataPresiksis);

        return view('peramalan.peramalan', compact('dataPresiksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peramalan  $peramalan
     * @return \Illuminate\Http\Response
     */
    public function show(Peramalan $peramalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peramalan  $peramalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Peramalan $peramalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peramalan  $peramalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peramalan $peramalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peramalan  $peramalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peramalan $peramalan)
    {
        //
    }
}
