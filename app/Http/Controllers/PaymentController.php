<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
    public function error(){
        return view('users.error');
    }

    public function detail($id){
        $payment = payment::where('id', $id)->get();
        return view('admin.detail', compact('payment'));
    }

    public function bukti($id){
        $takes = payment::where('id', $id)->get();
        return view('admin.bukti', compact('takes'));
    }

    public function updateComplated($id){
        Payment::where('user_id', $id)->update([
            'status' => 'Validasi',
            'done_time' => \Carbon\Carbon::now(),
        ]);
        return redirect()->back()->with('validasi', 'pembayaran telah di terima');
    }

    public function updateRefuse($id){
        Payment::where('user_id', $id)->update([
            'status' => 'tolak',
            'done_time' => \Carbon\Carbon::now(),
        ]);
        return redirect()->back()->with('tolak', 'pembayaran telah ditolak, silahkan cek kembali');
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
        // dd($request->all());
        $request->validate([
             'nama' => 'required',
            'bank' => 'required',
            'pemilik' => 'required',
            'nominal' => 'required',
            'bukti' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

        ]);
        $image = $request->file('bukti');
    $imgName = time(). rand().'.'.$image->extension();

    if(!file_exists(public_path('/assets/img/'.$image->getClientOriginalName()))){
       $destinationPath = public_path('/assets/img/');

       $image->move($destinationPath, $imgName);
       $uploaded = $imgName;
    } else {
       $uploaded = $image->getClientOriginalName();
    }

        payment::create([
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'bank' => $request->bank,
            'pemilik' => $request->pemilik,
            'nominal' => $request->nominal,
            'bukti' => $uploaded,
            'status' => 'proses',
        ]);

        return redirect()->back()->with('waitPay', 'silahkan tunggu verifikasi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}
