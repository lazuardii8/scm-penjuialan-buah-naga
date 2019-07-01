<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Produk;
use App\transaksi;
use App\Pencatatan;
use App\penjadwalan;
use App\penggunaanBahanBaku;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $pekerjas = User::where('role',2)->orderBy('created_at','asc')->get();
        $transaksis = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->get();
        $produks = Produk::orderBy('created_at','asc')->get();
        return view('ikan.daftar',compact('produks','no','pekerjas','transaksis'));
    }

    public function stokpenggunaanbahan(Request $request)
    {
        $pencatatan = Pencatatan::findOrFail($request->pencatatan_id);

        penggunaanBahanBaku::create([
            'pencatatan_id' => $request->pencatatan_id,
            'jumlah_awal'   => $pencatatan->jumlah_produk_satuan - $request->jumlah_penggunaan, 
            'jumlah_akhir'  => $request->jumlah_penggunaan
        ]);

        $pencatatan->update([
            'jumlah_produk_satuan' => $pencatatan->jumlah_produk_satuan - $request->jumlah_penggunaan,
        ]);

        // return redirect('/stok-bahan-baku');

    }

    public function stokbahan()
    {
        $stoks = Pencatatan::all();
        $no = 1;
        return view('ikan.bahanBaku', compact('stoks','no'));
    }

    public function penjadawalanAdd(Request $request)
    {

        // dd($request);

        penjadwalan::create([

            'job' => $request->job,
            'mesin_satu' => $request->mesin_satu,
            'mesin_dua' => $request->mesin_dua,

        ]);

        return redirect('/penjadwalan');

    }

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function penjadawalan()
    {
        $penjadwalans = penjadwalan::all();

        $dataPenjadwalan = array();

        foreach ($penjadwalans as $jadwal) {
            $data = array(
                'job' => $jadwal->job,
                'mesin_satu' => $jadwal->mesin_satu,
                'mesin_dua' => $jadwal->mesin_dua,
                'color' => '#'.$this->random_color(),
            );

            array_push($dataPenjadwalan,$data);
        }


        for ($i=0; $i<count($dataPenjadwalan); $i++){
            $terkecil = $dataPenjadwalan[$i];
            for ($j=$i ; $j<count($dataPenjadwalan) ; $j++){
                if ($dataPenjadwalan[$j]['mesin_satu'] <= $dataPenjadwalan[$i]['mesin_satu']){

                    $dataPenjadwalan[$i] = $dataPenjadwalan[$j];   
                    $dataPenjadwalan[$j] = $terkecil;
                    $terkecil = $dataPenjadwalan[$i];

                }
            }
        }

        $total_proses = 0;
        
        $tottal_mesin_satu=0;
        $tottal_mesin_dua=0;

        for ($i=0; $i < count($dataPenjadwalan) ; $i++) { 
         $tottal_mesin_satu += $dataPenjadwalan[$i]['mesin_satu'];
         $tottal_mesin_dua += $dataPenjadwalan[$i]['mesin_dua'];
     }

     if ($tottal_mesin_satu > $tottal_mesin_dua) {
         $total_proses = $tottal_mesin_satu;
     }else{
         $total_proses = $tottal_mesin_dua + $dataPenjadwalan[0]['mesin_satu'];

     }

     $jumlahAllA = 0;
     $jumlahAllB = 0;
     $jumlahmesin = 0;
     $jumlahmesin2 = 0;
     $jumlahmesin2on = 0;



     $jumlahmesinHitung =0;
     $jumlahmesinHitung2 =0;
     $jumlahmesinHitung2on =0;
     $jumlahAllBHitung =0;


     for ($index1 = 0; $index1 <count($dataPenjadwalan) ; $index1++) { 

        $jumlahmesinHitung += $dataPenjadwalan[$index1]['mesin_satu'];
        $jumlahmesinHitung2 += $dataPenjadwalan[$index1]['mesin_dua'];

        for ($z=0; $z <$dataPenjadwalan[$index1]['mesin_satu'] ; $z++) { 
            $jumlahAllBHitung += 1;
            if ($jumlahAllBHitung ==  $dataPenjadwalan[$index1]['mesin_satu']) {
                if ($jumlahmesinHitung2on < $jumlahmesinHitung) {
                    $jumlahmesinHitung2on++;

                }   
                for ($k=0; $k <$dataPenjadwalan[$index1]['mesin_dua'] ; $k++) { 
                    $jumlahmesinHitung2on++;
                }
                $jumlahAllBHitung = 0;
            }else{
                if ($jumlahmesinHitung2on < $jumlahmesinHitung) {
                    $jumlahmesinHitung2on++;
                }   

            }

        }

    }

        // dd($dataPenjadwalan);
    return view('ikan.penjadwalan', compact('total_proses','dataPenjadwalan','jumlahmesinHitung','jumlahmesin2on','jumlahmesinHitung2on','jumlahAllB','jumlahAllA','jumlahmesin','jumlahmesin2'));
}

public function catatBahan(Request $request)
{
        // dd($request);
    $this->validate($request,[
        'nama_produk'     => 'required|min:3',
        'jumlah_produk_satuan'     => 'required|min:1',
        'jumlah_produk_grup'     => 'required|min:1',
        'jenis_penyimpanan'     => 'required',
        'catatan'     => 'required|min:6'
    ]);

    if (Auth::check()) {
        if (Auth::user()->role == 1) {

            Pencatatan::create([
                'user_id' => Auth::user()->id,
                'nama_produk' => $request->nama_produk,
                'jumlah_produk_satuan'  => $request->jumlah_produk_satuan,
                'jumlah_produk_grup'  => $request->jumlah_produk_grup,
                'jenis_penyimpanan' => $request->jenis_penyimpanan,
                'catatan' => $request->catatan
            ]);

        }
    }

    return redirect('/stok-bahan-baku');
}

public function catatBahanUpdate(Request $request, $id)
{

    $pencatatan = Pencatatan::findOrFail($id);

    $this->validate($request,[
        'nama_produk'     => 'required|min:3',
        'jumlah_produk_satuan'     => 'required|min:1',
        'jumlah_produk_grup'     => 'required|min:1',
        'jenis_penyimpanan'     => 'required',
        'catatan'     => 'required|min:6'
    ]);

    if (Auth::check()) {
        if (Auth::user()->role == 1) {

           $pencatatan->update([
            'user_id' => Auth::user()->id,
            'nama_produk' => $request->nama_produk,
            'jumlah_produk_satuan'  => $request->jumlah_produk_satuan,
            'jumlah_produk_grup'  => $request->jumlah_produk_grup,
            'jenis_penyimpanan' => $request->jenis_penyimpanan,
            'catatan' => $request->catatan
        ]);

       }
   }

   return redirect('/stok-bahan-baku');
}

public function catatBahanDistroy($id)
{
    $pencatatan = Pencatatan::findOrFail($id);

    if (Auth::check() && Auth::user()->role == 1) {
        $pencatatan->delete();
    }else {
     abort(404);
 }

 return redirect('/stok-bahan-baku');

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'     => 'required|min:4',
            'stok'     => 'required|min:1',
            'harga'     => 'required|min:3',
            'satuan'     => 'required',
            'image'     => 'required',
            'deskripsi' => 'required|min:8'
        ]);
        // menjadi slug
        $slug = str_slug($request->name, '-');
        // chek apa lug ada yang sama
        if (Produk::where('slug',$slug)->first() != null) {
            $slug = $slug. '-' . time();
        }

        // dd($slug);

        $image = $request->file('image');
        $input['namefile'] = time().'-'.$image->getClientOriginalName();
        $tempat = public_path('image/projek');
        $image->move($tempat,$input['namefile']);

        if (Auth::check() && Auth::user()->role == 1) {
          Produk::create([
            'name' => $request->name,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'slug'  => $slug,
            'deskripsi' => $request->deskripsi,
            'image' => $input['namefile'],
            'satuan' => $request->satuan,
            'user_id'   => Auth::user()->id,
        ]);
      } 
      return redirect('/produk');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // dd('masuk');
       $ikan = Produk::where('slug',$slug)->first();
       // dd($ikan);
       return view('ikan.single_ikan', compact('ikan'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prodak = Produk::findOrFail($id);
        // validari
        $this->validate($request,[
            'name'     => 'required|min:4',
            'stok'     => 'required|min:1',
            'harga'     => 'required|min:3',
            'satuan'     => 'required',
            'deskripsi' => 'required|min:8'
        ]);

        $slug = str_slug($request->name, '-');

        // chek slug ada apa tidak di database
        if (Produk::where('slug',$slug)->first() != null) {
            $slug = $slug. '-' . time();
        }

        if (!empty($request->image)) {
            $image = $request->file('image');
            $input['namefile'] = time().'-'.$image->getClientOriginalName();
            $tempat = public_path('image/projek');
            $image->move($tempat,$input['namefile']);

            if (Auth::check() && Auth::user()->role == 1) {
                $prodak->update([
                 'name' => $request->name,
                 'stok' => $request->stok,
                 'harga' => $request->harga,
                 'slug'  => $slug,
                 'deskripsi' => $request->deskripsi,
                 'image' => $input['namefile'],
                 'satuan' => $request->satuan,
                 'user_id'   => Auth::user()->id,
             ]);

            }else {
               abort(404);
           }
       }else{
         if (Auth::check() && Auth::user()->role == 1) {
            $prodak->update([
             'name' => $request->name,
             'stok' => $request->stok,
             'harga' => $request->harga,
             'slug'  => $slug,
             'deskripsi' => $request->deskripsi,
             'satuan' => $request->satuan,
             'user_id'   => Auth::user()->id,
         ]);

        }else {
           abort(404);
       }
   }


   return redirect('/produk');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $produk = Produk::findOrFail($id);

     if (Auth::check() && Auth::user()->role == 1) {
      $produk->delete();
  }else {
     abort(404);
 }

 return redirect('/produk');
}
}
