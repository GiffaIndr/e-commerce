<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    //VALIDASI DATA YANG DIKIRIM
    $this->validate($request, [
        'product_id' => 'required|exists:products,id', //PASTIKAN PRODUCT_IDNYA ADA DI DB
        'qty' => 'required|integer' //PASTIKAN QTY YANG DIKIRIM INTEGER
    ]);

    //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
    $carts = json_decode($request->cookie('dw-carts'), true); 
  
    //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
    if ($carts && array_key_exists($request->product_id, $carts)) {
        //MAKA UPDATE QTY-NYA BERDASARKAN PRODUCT_ID YANG DIJADIKAN KEY ARRAY
        $carts[$request->product_id]['qty'] += $request->qty;
    } else {
        //SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUCT_ID
        $product = Product::find($request->product_id);
        //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
        $carts[$request->product_id] = [
            'qty' => $request->qty,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_price' => $product->price,
            'product_image' => $product->image
        ];
    }

    //BUAT COOKIE-NYA DENGAN NAME DW-CARTS
    //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
    $cookie = cookie('dw-carts', json_encode($carts), 2880);
    //STORE KE BROWSER UNTUK DISIMPAN
    return redirect()->back()->cookie($cookie);
}
}
