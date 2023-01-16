<?php

namespace App\Http\Controllers;

use App\Models\commer;
use App\Models\User;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class CommerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $feeds = Feed::all();
        $others = commer::orderBy('views', 'desc')->get();
        $commers = commer::all();
        return view('users.index', compact('commers', 'feeds', 'others'));
    }

    public function login(){
        return view('users.login');
    }

    public function register(){
        return view('users.register');
    }

    public function accountRegister(Request $request){
        // dd($request->all());
        $request->validate([
            'password' => 'required|min:8',
            'name' => 'required',
            'email' => 'required|email:dns',
           
        ]);
        User::create([
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'done_time' => \Carbon\Carbon::now(),
        ]);
        return redirect()->route('login')->with('successLogin', 'Berhasil membuat akun! Silahkan masuk');
    }

    public function Auth(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => 'email ini belum tersedia',
                'email.required' => 'email harus diisi',
               'password.required' => 'password harus diisi',
        ]);
        $user =$request->only('email', 'password');
        if(Auth::attempt($user)) {
            return redirect()->route('landing');
        }else{
            return redirect()->back()->with('error', 'Gagal login, silahkan cek kembali');
        }
      
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function pembayaran(){
        return view('users.pembayaran');
    }

    
    public function dashboardAdmin(){
        return view('admin.dashboard');
    }

    public function chart(Request $request){
        $commers = commer::all();
        return view('users.chart', compact('commers'));
    }

public function screen($id){
    db::table('commers')->where('id', $id)->increment('views');
    $commers = commer::where('id' ,$id)->get();
    return view('users.screen', compact('commers'));
}

public function errorlogin(){
    return view('users.errorlogin');
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
    //   dd($request->all());
    $request->validate([
        'barang' => 'required',
        'harga' => 'required',
        'jumlah' => 'required',
        'description' => 'required',
        'jenis' => 'required',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
    ]);
    $image = $request->file('image');
    $imgName = time(). rand().'.'.$image->extension();
    if(!file_exists(public_path('/assets/img/'.$image->getClientOriginalName()))){
        $destinationPath = public_path('/assets/img/');
 
        $image->move($destinationPath, $imgName);
        $uploaded = $imgName;
     } else {
        $uploaded = $image->getClientOriginalName();
     }

     Commer::create([
        'user_id' => Auth::user()->id,
        'barang' => $request->barang,
        'harga' => $request->harga,
        'jumlah' => $request->jumlah,
        'jenis' => $request->jenis,
        'views' => $request->views,
        'image' => $uploaded,
        'description' => $request->description,
        'status' => 'proses',
     ]);
     return redirect()->back()->with('berhasilTambah', 'anda berhasil menambahkan produk!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\commer  $commer
     * @return \Illuminate\Http\Response
     */
    public function show(commer $commer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\commer  $commer
     * @return \Illuminate\Http\Response
     */
    public function edit(commer $commer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\commer  $commer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, commer $commer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\commer  $commer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Commer::find($id)->delete();
      return redirect()->route('landing')->with('hapus', 'produk berhasil dihapus');
    }
}
