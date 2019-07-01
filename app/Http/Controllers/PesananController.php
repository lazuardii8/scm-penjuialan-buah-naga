<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\order;
use App\Produk;
use App\transaksi;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = order::where('pemilik_id',Auth::user()->id)->where('status','proses')->get();
        // dd($orders);
        return view('transaksi.pesanan', compact('orders'));
    }

    public function destroyOrders($id)
    {
        $order = order::findOrFail($id);
        $produk = Produk::findOrFail($order->produk_id);

        if (Auth::check()) {
            $produk->update([
                'stok' => $produk->stok + $order->jumlah
            ]);
            $order->delete();
        }else {
           abort(404);
       }
       return redirect('/pesanan');
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
        if (Auth::user()->role == 3) {
         $this->validate($request,[
            'jumlah' => 'required',
        ]);
           // dd('masuk');

         $ikan = Produk::findOrFail($request->id_ikan);
         if ($request->jumlah > $ikan->stok) {
          return Redirect()->back()->withErrors(['Pembelian berlebih']);
      }else if($request->jumlah <= 0){
        return Redirect()->back()->withErrors(['Terjadi kesalahan']);
    }else{
       $ikan->update([
        'stok'     => $ikan->stok - $request->jumlah,
    ]);

       $order_ikan = order::where('produk_id',$request->id_ikan)->where('pemilik_id',Auth::user()->id)->first();
         // dd($order_ikan->total_harga);
       if ( order::where('produk_id',$request->id_ikan)->where('status','proses')->where('pemilik_id',Auth::user()->id)->first() != null) {
         $order_ikan->update([
            'jumlah' => $request->jumlah + $order_ikan->jumlah,
            'total_harga' => ($request->jumlah * $ikan->harga) + $order_ikan->total_harga,
        ]);
         return Redirect('/');
     }else{
         order::create([
            'jumlah' => $request->jumlah,
            'total_harga' => $request->jumlah * $ikan->harga,
            'pemilik_id' => Auth::user()->id,
            'produk_id' => $request->id_ikan,
        ]);
         return Redirect('/');
     }

     return Redirect('/');

 }

}
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
    public function bayarProduk(Request $request)
    {
        // dd('masuk');
        $transaksiGan = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->where('orders.pemilik_id','=',Auth::user()->id)->where('orders.status','sudah')->where('transactions.id_pembayaran', null)->first();
        
        // dd($transaksiGan);
        $id_pesanan = explode(",",$request->id_pesanan);
        // dd($_pesanan[0]);
        // dd($id_pesanan[0]);
        if (empty($transaksiGan->totalBayar)) {
            for ($i=0; $i < count($id_pesanan) ; $i++) { 
                transaksi::create([
                    'order_id' => $id_pesanan[$i],
                    'totalBayar' => $request->jumlahTotal,
                ]);

                $udaptePesanan = order::findOrFail($id_pesanan[$i]);

                $udaptePesanan->update([
                    'status' => 'sudah'
                ]);
            }
        }else{
            for ($i=0; $i < count($id_pesanan) ; $i++) { 
                transaksi::create([
                    'order_id' => $id_pesanan[$i],
                    'totalBayar' => $request->jumlahTotal + $transaksiGan->totalBayar,
                ]);

                $transaksis = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->where('orders.pemilik_id','=',Auth::user()->id)->where('orders.status','sudah')->where('transactions.id_pembayaran', null)->get();

                if (count($transaksis)>0) {
                    foreach ($transaksis as $transaksi) {

                     $transaksiUpdate = transaksi::where('order_id',$transaksi->id)->first();
                       // dd($transaksiUpdate);

                     $transaksiUpdate->update([
                        'totalBayar' => $request->jumlahTotal + $transaksiGan->totalBayar,
                    ]);
                 }
             }

             $udaptePesanan = order::findOrFail($id_pesanan[$i]);

             $udaptePesanan->update([
               'status' => 'sudah'
           ]);
         }
     }


     return redirect('/transaksi-pembayaran');

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
