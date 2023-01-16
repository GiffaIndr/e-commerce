@extends('layout.layout')
@section('content')
@if(Auth::check())
@foreach($commers as $commer)
@endforeach

<h1>{{ ucfirst(auth()->user()->role) }}</h1>
  <div class="small-container single-product">
    <div class="row">
        <div class="col-2">
        <img src="{{asset('assets/img/'.$commer->image)}}" width="100%" 
        id="ProductImg">

    </div>
    <div class="col-2">
        <p>Produk {{$commer->jenis}}</p>
        <h5>Views: {{$commer->views}} </h5>
        <h4>{{$commer->barang}}</h4>
        <h4>Rp.{{$commer->harga}}</h4>
        <form action="#" method="post">
            @csrf
    <input typ="number" name="value" value="">
    <input  type="submit" value="Add Chart" style="width: 150px" class="btn"></input>
</form>
<h3>Product Details<i class="fa fa-indent"></i></h3>
    <br>
    <p>{{$commer->description}}</p>
</div>
</div>
</div>
</body>
@endif
<script>
var ProductImg = document.getElementById("ProductImg");
var SmallImg = Document.getElementByClassName("small-img");

SmallImg[0].onclick = function()
{
    ProductImg.src =SmallImg[0].src;
}
SmallImg[1].onclick = function()
{
    ProductImg.src =SmallImg[1].src;
}
SmallImg[2].onclick = function()
{
    ProductImg.src =SmallImg[2].src;
}
SmallImg[3].onclick = function()
{
    ProductImg.src =SmallImg[3].src;
}
</script>
@endsection