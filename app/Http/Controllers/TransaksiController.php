<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\order;
use App\Produk;
use App\transaksi;
use App\pembayaran;
use App\pengiriman;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pembayaranProduk()
    {
        $transaksi = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->where('orders.pemilik_id','=',Auth::user()->id)->where('orders.status','sudah')->where('transactions.id_pembayaran', null)->first();
        // dd($transaksi);
        return view('transaksi.pembayaran', compact('transaksi'));
    }

    public function ucapanBerhasil()
    {
        return view('transaksi.ucapan');
    }

    public function pembayaranUpload(Request $request)
    {
       $transaksis = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->where('orders.pemilik_id','=',Auth::user()->id)->where('orders.status','sudah')->where('transactions.id_pembayaran', null)->get();


       $this->validate($request,[
        'norekening' => 'required|max:19',
        'image' => 'required'
    ]);

       $image = $request->file('image');
       $input['namefile'] = time().'-'.$image->getClientOriginalName();
       $tempat = public_path('image/atm');
       $image->move($tempat,$input['namefile']);

       $pembayarantTransaksi = pembayaran::create([
        'norekening' => $request->norekening,
        'fotoPembayaran'      => $input['namefile']
    ]);

    // dd($pembayarantTransaksi->id);

       if (count($transaksis)>0) {
        foreach ($transaksis as $transaksi) {

         $transaksiUpdate = transaksi::where('order_id',$transaksi->id)->first();

         $transaksiUpdate->update([
            'id_pembayaran' => $pembayarantTransaksi->id,
            'status' => 'dibayar',
        ]);
     }
 }

 return redirect('/transaksi-berhasil');
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

    public function historyPesanan()
    {
        $no =1;

        if (Auth::check()) {
            $historys = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->where('orders.pemilik_id', Auth::user()->id)->get();
            // dd($historys);

            return view('pembeli.history', compact('historys','no'));
        }else{
           abort(404);
       }
   }

   public function getPembayaranverif()
   {
    $no = 1;
    $verifikasiPembayran = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->get();
    return view('transaksi.verifikasi',compact('verifikasiPembayran','no'));
}

public function updatePembayaran(Request $request, $id)
{
    $pembayaran = pembayaran::findOrFail($id);
    // $data = $pembayaran->update([
    //     'status_pesanan' => $request->data
    // ]);
    if($request->data == 'diproses'){
       $pengiriman  = pengiriman::where('pembayaran_id',$id)->first();
       if ($pengiriman != null) {
         $pengiriman->delete();
     }
     $data = $pembayaran->update([
        'status_pesanan' => 'diproses'
    ]);
 }else if ($request->data == 'proses pengiriman') {
     $pengiriman  = pengiriman::where('pembayaran_id',$id)->first();
     if ($pengiriman != null) {
         $pengiriman->delete();
     }
     $data = $pembayaran->update([
        'status_pesanan' => 'proses pengiriman'
    ]);
 }else if($request->data == 'pengiriman'){
    $pengiriman  = pengiriman::where('pembayaran_id',$id)->first();
    if ($pengiriman != null) {
        $data = $pembayaran->update([
           'status_pesanan' => 'pengiriman'
       ]);
    }else{
        $data = dd();
    }  
}else if($request->data == 'sampai'){
    $pengiriman = pengiriman::where('pembayaran_id',$id)->first();
    if ($pengiriman == null) {
       $data = dd();
   } else {
       $data =  $pembayaran->update([
           'status_pesanan' => 'sampai'
       ]);
   }

}

    // return Response::json($data);
return response()->json($data);
}

public function pengirimanDataPesanan()
{
   $no = 1;
   $pengirimans = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->join('pengiriman','pengiriman.pembayaran_id','=','pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->where('pengiriman.pekerja_id',Auth::user()->id)->where(function ($query)
   {
    $query->where('pembayaran.status_pesanan','pengiriman')->orWhere('pembayaran.status_pesanan','sampai');
})->get();
   return view('pekerja.pengiriman_pesanan_pekerja',compact('pengirimans','no'));
}

public function pengirimanPekerja(Request $request)
{
    $pengiriman = pengiriman::where('pembayaran_id', $request->id_pembayaran)->first();
    $pembayaran = pembayaran::where('id',$request->id_pembayaran)->first();

    $pembayaran->update([
        'status_pesanan' => 'pengiriman'
    ]);

    if ($pengiriman == null ){
        $data = pengiriman::create([
            'pekerja_id' => $request->id_pekerja,
            'pembayaran_id' => $request->id_pembayaran
        ]);
    } else {
      $data = $pengiriman->update([
        'pekerja_id' => $request->id_pekerja
    ]);
  }
  return response()->json($data);
}


public function updatePaketPengiriman(Request $request)
{
   $pembayaran = pembayaran::where('id',$request->id_pembayaran)->first();
   if ($request->pilihan == 'sampai') {
       $data = $pembayaran->update([
        'status_pesanan' => 'sampai'
    ]);
   } else if($request->pilihan == 'pengiriman'){
       $data = $pembayaran->update([
        'status_pesanan' => 'pengiriman'
    ]);
   }

   return response()->json($data);

}

public function pengirimanPesanan()
{
    $no = 1;
    $pengirimans = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->where('pembayaran.status_pesanan','proses pengiriman')->get()
    ;
    $drivers = User::where('role',2)->get();
    return view('transaksi.pengiriman',compact('pengirimans','no','drivers'));
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
