@extends('layout.admin')
@section('content')
<form action="{{route('barang.input')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card shadow" style="margin-left: 400px; margin-right:200px;">
        @if($errors->any())
  <span style="background-color: rgba(255, 0, 0, 0.24); border-radius:20px; posisition: center; padding-right: 20px; ">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </ul>
  </span>
  @endif
    <div class="container" style="margin-left: 100px; padding-right: 200px; margin-top: 50px; margin-bottom: 50px;">
        <h3>Input Barang</h3>
        @if(Session::get('berhasilTambah'))
  <div class="alert alert-success">
  {{Session::get('berhasilTambah')}}</div>
  @endif
        <hr>
    <div class="form-row">
      <div class="col d-flex">
        <input type="text" name="barang" class="form-control" placeholder="nama barang">
        <br>
        <select name="jenis" style="border-radius: 10px;" placeholder="jenis">
          <option hidden> Jenis Barang</option>
          <option value="Makanan">Makanan</option>
          <option value="Jasa">Jasa</option>
        </select>
      </div>
      <br>
      <div  class="col">
        <input type="text" name="harga" id="harga" class="form-control" placeholder="harga">
      </div>
      <br>
      <div class="col">
        <input type="number" name="jumlah" class="form-control" placeholder="jumlah">
      </div>
      <br>
      <div class="col">
        <input type="file" name="image" class="form-control" placeholder="tambah gambar">
      </div>
      <br>
      <textarea name="description" class="form-control" id="textAreaExample1" rows="4" placeholder="deskripsi"></textarea>
      <br>  
      <button type="submit" class="btn btn-warning shadow">Submit</button>
    </div>
    </div>
    </div>
  </form>
  


<div class="container" style="margin-top: 50px; margin-left: 400px; padding-right: 200px;">
<table class="table" style="">
<thead>
<tr>
<th scope="col">No</th>
<th scope="col">Product ID</th>
<th scope="col">Product</th>
<th scope="col">Category</th>
<th scope="col">Price</th>
<th scope="col">Views</th>
<th scope="col">action</th>
</tr>
</thead>
@foreach ($commers as $commer)
<tbody>
<tr>
<th scope="row">{{$loop->iteration}}</th>
<td>{{$commer->id}}</td>
<td>{{$commer->barang}}</td>
<td>{{$commer->jenis}}</td>
<td>{{$commer->harga}}</td>
<td>{{$commer->views}}</td>
<td> <form  action="{{route('delete', $commer->id)}}" method="post">
@method('DELETE')
@csrf
<br>
<button type="submit" class="fas fa-trash" style="border: 20px solid rgba(255, 255, 255, 0.573); border-radius:20%; font-size:15px;"></button>
</form></td>
</tr>
</tbody>
@endforeach

</table>
  <script>


  </script>
@endsection