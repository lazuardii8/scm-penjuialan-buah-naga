<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\data;
use App\Produk;
use Illuminate\Support\Facades\Storage;
use Hash;
use validate;
use Illuminate\Contracts\Encryption\DecryptException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $search = urldecode($request->input('search'));
     if (!empty($search)) {

      $produks = Produk::orderBy('created_at','des')->where('name', 'like', '%'.$search.'%')->paginate(20);
    }else{
      $produks = Produk::orderBy('created_at','des')->paginate(20);
    }
    return view('welcome2',compact('produks'));
  }

  public function setting($id)
  {
    $user = User::findOrFail($id);
    $data = data::where('user_id',$id)->first();
    return view('setting.setting', compact('user','data'));
  }
  public function updateProfile(Request $request, $id)
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

      if (Auth::check() && Auth::user()->role == 3) {

        if ( Auth::user()->id == $id || Auth::user()->isAdmin()) {
          if (Hash::check($request->passwordLama, Auth::user()->password,[]) == false) {
            return back()->withInput()->withErrors(array('passwordLama' =>'Password tidak cocok'));
            // dd('salah lama');
          } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
            return back()->withInput()->withErrors(array('passwordBaru' => 'Password tidak cocok'));
          }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
            $user->password = bcrypt($request->passwordBaru);
            $user->save();
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
           return back()->withInput()->withErrors(array('passwordLama' =>'Password tidak cocok'));
         } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
          return back()->withInput()->withErrors(array('passwordBaru' => 'Password tidak cocok'));
        }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
          $user->password = bcrypt($request->passwordBaru);
          $user->save();
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
         return back()->withInput()->withErrors(array('passwordLama' =>'Password tidak cocok'));
       } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
         return back()->withInput()->withErrors(array('passwordBaru' => 'Password tidak cocok'));
       }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
        $user->password = bcrypt($request->passwordBaru);
        $user->save();
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
        return back()->withInput()->withErrors(array('passwordLama' =>'Password tidak cocok'));
      } else if((strcmp($request->passwordBaru, $request->passwordKonfirm)==0) == false){
        // dd('tdk cocok');
       return back()->withInput()->withErrors(array('passwordBaru' => 'Password tidak cocok'));
     }else if(Hash::check($request->passwordLama, Auth::user()->password,[]) && strcmp($request->passwordBaru, $request->passwordKonfirm)==0){
        // dd('bener');
      $user->password = bcrypt($request->passwordBaru);
      $user->save();
    }
  }else {
    abort(404);
  }
}
}else{
  abort(404);  
}

if (!empty($request->image)) {
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

}else{
  $user->update([
    'name' => $request->name,
    'username' => $request->username,
    'email' => $request->email
  ]); 
}


$data->update([
  'alamat' => $request->alamat,
  'nohp' => $request->nohp,
]);

return redirect('/');
}
}
