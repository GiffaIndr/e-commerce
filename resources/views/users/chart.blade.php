<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>chart</title>
  <link href="{{asset('assets/css/chart.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
 
  <link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
 <!-- Swiper CSS -->
 <link rel="stylesheet" href="css/swiper-bundle.min.css" />

 <!-- CSS -->
 <link rel="stylesheet" href="css/style.css" />

 <!-- Boxicons CSS -->
 <link
   href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
   rel="stylesheet"
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet"
  />
</head>
<style>
  *{
      text-decoration: none !important;
      font-size: 20px;
  }
  input{
    padding-bottom: 200px;
  }
</style>

 <body>
  <header class="header">
      <a href="{{route('landing')}}" class="logo"> <i class="fas fa-shopping-cart"></i> Daftar Belanjaan </a>
      <nav class="navbar">
       
      </nav>
      <div class="icons">
          <div id="login-btn" class="fas fa-user"> {{Auth::user()->name}}</div>
      </div>
     
  </header>

  
  <section> 
    @foreach($commers as $commer)
    <article class="product" style="margin-top: 100px;">
      <header>
        <a class="remove">
          <img src="{{asset('assets/img/'. $commer->image)}}" alt="">

          <h3> Views : {{$commer->views}}</h3>
        </a>
      </header>

      <div class="content">

        <h1>{{$commer->barang}}</h1>

       {{$commer->description}}

       
      </div>

      <footer class="content">

    

        <a class="full-price">
        Rp. {{$commer->harga}}</a>

    
       
        </h2>
      </footer>
    </article>

    @endforeach
  </section>



  @if(is_null(Auth::user()->payment))
  
  @elseif(Auth::user()->payment->status == 'tolak')
  <section>
  <div class="alert alert-danger"><p>Pembayaran Ditolak</p></div>
  </section>
    @elseif(Auth::user()->payment->status == 'validasi')
    <section>
    <div class="alert alert-success"><p style="font-size:20px">Pembayaran Berhasil</p></div>
    </section>
  @else
  <section>
  <div class="alert alert-warning"><p>Pembayaran sedang di verifikasi</p></div>
  </section>
  @endif
  <div class="container" style="margin-top: 30px; padding-left: 100px; padding-right: 100px; padding-bottom: 200px; width:1000px;">
    <div class="card p-2 shadow" style="width:800px; padding-bottom: 20px;">
     
      <form action="/chart/input" method="POST" style="padding-left: 20px; padding-right: 20px; padding-top: 20px; padding-bottom: 20px;"  enctype="multipart/form-data">
        @csrf
   
        <p class="text-center"><b>Form Pembayaran</b></p>
        <div class="form-group col-5">
          <label for="inputPassword4">Nama Barang</label>
          <select type="text" name="nama" class="form-control" id="inputPassword4" placeholder="nama"><option>{{$commer->barang}}</option></select>
        </div>
        <hr>
       
        <div class="form-row row d-flex ">
          <div class="form-group col-6" style="margin-right:50px;">
            <label for="inputEmail4">Method pembayaran</label><br>
              <select type="search" name="bank" class="text-box" placeholder="bank" required>
         <option hidden disable selected>Pilih Pembayaran</option>
         @foreach($takes as $bank)
         <option>{{$bank['name']}}</option>
      @endforeach
      </select>
          </div>
          <div class="form-group col-5">
            <label for="inputPassword4">Nama Pemilik Rekening</label>
            <input type="text" name="pemilik" class="form-control" id="inputPassword4" placeholder="nama">
          </div>
        </div>
        <div class="form-row d-flex">
        <div class="form-group col-12 pt-2">
          <label for="inputEmail4">Nominal</label>
          <select type="number" name="nominal" id="nominal" class="form-control" placeholder="nominal"><option>{{$commer->harga}}</option></select>
        </div> 
        </div>
        <div class="form-group">
          <div class="form-group pt-3">
          <label for="inputEmail4">Foto Bukti</label>
          <input type="file" name="bukti" class="form-control" id="inputEmail4" placeholder="Uploaf">
        </div>
        </div>
        <br>
        <input type="submit" name="submit" class="  btn btn-warning"></input>
        <br>
      </div>
    </div>
    </form>
    </div>
</div>
  </div>
  @yield('content')
</body>
<script src="{{asset('assets/js/script.js')}}"></script>

</html>
