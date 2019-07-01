<?php

namespace App\Http\Controllers;

use App\User;
use App\data;
use App\Produk;
use App\transaksi;
use App\Pencatatan;
use App\Suplier;
use App\SuplierHistory;
use Auth;
use Hash;
use validate;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;


class SuplierController extends Controller
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
      $supliers = User::where('role',4)->orderBy('created_at','asc')->get();
      $transaksis = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->get();
      $produks = Produk::all();
      return view('suplier.tambah', compact('no','pekerjas','produks','transaksis','supliers'));
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
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'alamat' => 'required|string',
        'image' => 'required',
        'username' => 'required|string',
        'nohp' => 'required|string',
      ]);

      $image = $request->file('image');
      $input['namefile'] = time().'-'.$image->getClientOriginalName();
      $tempat = public_path('image/projek');
      $image->move($tempat,$input['namefile']);

      if (Auth::check() && Auth::user()->role == 1) {
        $user = User::create([
          'name' => $request->name,
          'username' => $request->username,
          'image'     => $input['namefile'],
          'role'  => 4,
          'status'  => 'kosong',
          'email' => $request->email,
          'token'     => str_random(25),
          'password' => bcrypt($request->password),
        ]); 
        data::create([
          'alamat' => $request->alamat,
          'nohp' => $request->nohp,
          'user_id'   => $user->id,
        ]);
      } 
      return redirect('/suplier-user');
    }

    public function suplierBahan()
    {
      $pencatatans = Pencatatan::all();
      $supliers = suplier::all();
      $no = 1;
      return view('suplier.bahan', compact('pencatatans','supliers','no'));
    }

    public function updateInvest(Request $request,$id)
    {

      $suplier = Suplier::findOrFail($id);

      $suplier->update([
        'pencatatan_id' => $request->pencatatan_id,
        'jumlah_awal' => $request->jumlah_awal,
        'status_kemasan' => $request->status_kemasan,
        'jumlah_tetap_awal' => $request->jumlah_awal,
        'status' => $request->status,
      ]);

      return redirect('/suplier-bahan');
    }

    public function suplierBahanDestroy($id)
    {
      $suplierBahan = Suplier::findOrFail($id);

      if (Auth::check()) {
        $suplierBahan->delete();
      } 


      return redirect('/suplier-bahan');
      
    }

    public function storeInvest(Request $request)
    {
      Suplier::create([
        'user_id' => Auth::user()->id,
        'pencatatan_id' => $request->pencatatan_id,
        'jumlah_awal' => $request->jumlah_awal,
        'jumlah_akhir' => 0,
        'jumlah_tetap_awal' => $request->jumlah_awal,
        'jumlah_tetap_akhir' => 0,
        'status_kemasan' => $request->status_kemasan,
        'status' => 'invest',
      ]);

      return redirect('/suplier-bahan');
    }

    public function investasiSUplier()
    {
      $supliers = Suplier::where('status','invest')->get();
      return view('suplier.invest',compact('supliers'));
    }

    public function InvestBahanSuplier(Request $request, $id)
    {
     $suplier = Suplier::findOrFail($id);
     $pencatatan = Pencatatan::findOrFail($request->idpencatatan);

     $suplier->update([
      'jumlah_awal' => $suplier->jumlah_awal - $request->jumlah_invest,
      'jumlah_akhir' => $suplier->jumlah_akhir + $request->jumlah_invest,
      'jumlah_tetap_akhir' => $suplier->jumlah_tetap_akhir + $request->jumlah_invest,
    ]);

     SuplierHistory::create([
      'suplier_id' => $id,
      'jumlah_invest' => $request->jumlah_invest,
      'user_id'    => Auth::user()->id
    ]);

     return redirect('/suplier-investasi');

   }

   public function historrySUplier()
   {
    $historys = SuplierHistory::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
    $no = 1;
    return view('suplier.history', compact('historys','no'));
  }

  public function validasiInvestSUplier($value='')
  {
    $historys = SuplierHistory::orderBy('created_at','desc')->get();
    $no = 1;
    return view('suplier.adminInvest', compact('historys','no'));
  }

  public function updateInvestSuplier(Request $request, $id)
  {
    $history = SuplierHistory::findOrFail($id);
    $suplier = Suplier::findOrFail($history->suplier_id);
    $pencatatan = Pencatatan::findOrFail($suplier->pencatatan_id);


    if ($request->status_terima == 'diterima' || $request->status_terima == 'diproses' ) {

      if ($request->status_terima == 'diproses' && $history->status_terima == 'diterima') {
        $pencatatan->update([
          'jumlah_produk_satuan' => $pencatatan->jumlah_produk_satuan - $history->jumlah_invest,
        ]);
      }

      if ($request->status_terima == 'diproses' && $history->status_terima == 'ditolak') {

       $suplier->update([
        'jumlah_awal' => $suplier->jumlah_awal - $history->jumlah_invest,
        'jumlah_akhir' => $suplier->jumlah_akhir + $history->jumlah_invest,
        'jumlah_tetap_akhir' => $suplier->jumlah_tetap_akhir + $history->jumlah_invest,
      ]);
     } 

     if ($request->status_terima == 'diterima'  && $history->status_terima == 'ditolak') {
      $pencatatan->update([
        'jumlah_produk_satuan' => $pencatatan->jumlah_produk_satuan + $history->jumlah_invest,
      ]);

      $suplier->update([
        'jumlah_awal' => $suplier->jumlah_awal - $history->jumlah_invest,
        'jumlah_akhir' => $suplier->jumlah_akhir + $history->jumlah_invest,
        'jumlah_tetap_akhir' => $suplier->jumlah_tetap_akhir + $history->jumlah_invest,
      ]);
    }

    if ($request->status_terima == 'diterima'  && $history->status_terima == 'diproses') {
      $pencatatan->update([
        'jumlah_produk_satuan' => $pencatatan->jumlah_produk_satuan + $history->jumlah_invest,
      ]);
    }

    $history->update([
      'status_terima' => $request->status_terima
    ]);



  } else if($request->status_terima == 'ditolak'){


    if ($history->status_terima == 'diterima') {
     $pencatatan->update([
      'jumlah_produk_satuan' => $pencatatan->jumlah_produk_satuan - $history->jumlah_invest,
    ]);
   }

   $suplier->update([
    'jumlah_awal' => $suplier->jumlah_awal + $history->jumlah_invest,
    'jumlah_akhir' => $suplier->jumlah_akhir - $history->jumlah_invest,
    'jumlah_tetap_akhir' => $suplier->jumlah_tetap_akhir - $history->jumlah_invest,
  ]);

   $history->update([
    'status_terima' => $request->status_terima
  ]);

 }

 return redirect('/suplier-investasi/validasi');

}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
     $user = User::findOrFail($id);
     $data = data::where('user_id',$id)->first();

     if (Auth::check() && Auth::user()->role == 1) {
       $data->delete();
       $user->delete();
     }else {
       abort(404);
     }

     return redirect('/suplier-user');
   }

   public function update_keamanan(Request $request, $id)
   {
    $user = User::findOrFail($id);
    $data = data::where('user_id',$id)->first();


 // validari
    if (empty($request ->passwordLama) && empty($request ->passwordBaru) && empty($request ->passwordKonfirm)) {
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required',
        'alamat' => 'required|string',
        'username' => 'required|string',
        'image' => 'required',
        'nohp' => 'required|string',
      ]);
    }else if(($request->email == $user->email) && empty($request ->passwordLama) && empty($request ->passwordBaru) && empty($request ->passwordKonfirm)){
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required',
        'alamat' => 'required|string',
        'username' => 'required|string',
        'image' => 'required',
        'nohp' => 'required|string',
      ]);
    }else if ($request->email == $user->email) {
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required',
        'alamat' => 'required|string',
        'username' => 'required|string',
        'image' => 'required',
        'nohp' => 'required|string',
        'passwordLama' => 'string|min:6',
        'passwordBaru' => 'required|string|min:6',
        'passwordKonfirm' => 'required|string|min:6'
      ]);

      if (Auth::check() && Auth::user()->role == 1) {

        if ( Auth::user()->id == $id || Auth::user()->isAdmin()) {
          if (Hash::check($request->passwordLama, Auth::user()->password,[]) == false) {
            // dd('salah lama');
            return redirect('/suplier-user');
          } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
            return redirect('/suplier-user');
          }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
            $user->password = bcrypt($request->passwordBaru);
            $user->save();
            return redirect('/suplier-user');
          }
        }else {
          abort(404);
        }
      }

    }else if($request->email != $user->email){
      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'alamat' => 'required|string',
        'username' => 'required|string',
        'image' => 'required',
        'nohp' => 'required|string',
        'passwordLama' => 'string|min:6',
        'passwordBaru' => 'required|string|min:6',
        'passwordKonfirm' => 'required|string|min:6'
      ]);

      if (Auth::check() && Auth::user()->role == 1) {

        if ( Auth::user()->id == $id || Auth::user()->isAdmin()) {
          if (Hash::check($request->passwordLama, Auth::user()->password,[]) == false) {
            // dd('salah lama');
            return redirect('/suplier-user');
          } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
            return redirect('/suplier-user');
          }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
            $user->password = bcrypt($request->passwordBaru);
            $user->save();
            return redirect('/suplier-user');
          }
        }else {
          abort(404);
        }
      }

    }else if(!empty($request ->passwordLama) && !empty($request ->passwordBaru) && !empty($request ->passwordKonfirm)){

      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required',
        'alamat' => 'required|string',
        'username' => 'required|string',
        'image' => 'required',
        'nohp' => 'required|string',
        'passwordLama' => 'string|min:6',
        'passwordBaru' => 'required|string|min:6',
        'passwordKonfirm' => 'required|string|min:6'
      ]);

      if (Auth::check() && Auth::user()->role == 1) {

        if ( Auth::user()->id == $id || Auth::user()->isAdmin()) {
          if (Hash::check($request->passwordLama, Auth::user()->password,[]) == false) {
            // dd('salah lama');
            return redirect('/suplier-user');
          } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
            return redirect('/suplier-user');
          }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
            $user->password = bcrypt($request->passwordBaru);
            $user->save();
            return redirect('/suplier-user');
          }
        }else {
          abort(404);
        }
      }
    }else if(($request->email == $user->email) && !empty($request ->passwordLama) && !empty($request ->passwordBaru) && !empty($request ->passwordKonfirm)){

      $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'alamat' => 'required|string',
        'username' => 'required|string',
        'image' => 'required',
        'nohp' => 'required|string',
        'passwordLama' => 'string|min:6',
        'passwordBaru' => 'required|string|min:6',
        'passwordKonfirm' => 'required|string|min:6'
      ]);

      if (Auth::check() && Auth::user()->role == 1) {

        if ( Auth::user()->id == $id || Auth::user()->isAdmin()) {
          if (Hash::check($request->passwordLama, Auth::user()->password,[]) == false) {
            // dd('salah lama');
            return redirect('/suplier-user');
          } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
            return redirect('/suplier-user');
          }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
            $user->password = bcrypt($request->passwordBaru);
            $user->save();
            return redirect('/suplier-user');
          }
        }else {
          abort(404);
        }
      }
    }else{
      abort(404);  
    }

    $image = $request->file('image');
    $input['namefile'] = time().'-'.$image->getClientOriginalName();
    $tempat = public_path('image/projek');
    $image->move($tempat,$input['namefile']);

    $user->update([
      'name' => $request->name,
      'username' => $request->username,
      'image'     => $input['namefile'],
      'email' => $request->email
    ]); 
    $data->update([
      'alamat' => $request->alamat,
      'nohp' => $request->nohp,
    ]);


    return redirect('/suplier-user');
  }
}
