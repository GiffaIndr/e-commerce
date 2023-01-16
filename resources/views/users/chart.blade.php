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

          <h3>Remove product</h3>
        </a>
      </header>

      <div class="content">

        <h1>{{$commer->barang}}</h1>

       {{$commer->description}}

       
      </div>

      <footer class="content">

        <span class="qt">2</span>

        <a class="full-price">
          Beli Produk</a>

        <h2 class="price">Rp.
        {{$commer->harga}}
        </h2>
      </footer>
    </article>

    @endforeach
  </section>
  @yield('content')
</body>
<script src="{{asset('assets/js/script.js')}}"></script>

</html>
