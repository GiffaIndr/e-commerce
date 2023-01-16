@extends('layout.layout')
@section('content')
<section class="home" id="home" style="background: url('{{asset('assets/img/smk.jpg')}}');">
    <div class="content">
        <h3>WIKRAMA<span> SHOP</span> </h3>
        <h2>BUY <span>BEST PRODUCT</span> ONLINE </h2>
        <a href="#product" class="btn">SHOP NOW</a>
    </div>
</section>

<br>
@if (session('notAllowed'))
<div class="alert alert-success">
    {{ session('notAllowed') }}
</div>
@endif
<h1 class="heading"> <span>Most </span> favourite</h1>
@foreach($others as $other)

<section class="banner-container">
    <div class="banner">
        <h1>TOP #{{$loop->iteration}}</h1>
        <img src="{{asset('assets/img/'. $other->image)}}" alt="">
        <div class="content">
            <span>{{$other->jenis}}</span>
            <h3>{{$other->barang}}</h3>
            <a href="{{route('screen.product', $other->id)}}" class="btn">shop now</a>
        </div>
    </div>

</section>
@endforeach

<section class="product" id="product">
    <h1 class="heading"> All <span>products</span><br></h1>
    <div class="box-container">
@foreach($commers as $commer)
        <div class="box">
            <div class="image">
                <img src="{{asset('assets/img/'. $commer->image)}}" alt="">
            </div>
            <div class="content">
                <h3>{{$commer->barang}}</h3>
                <div class="price">Rp.{{$commer->harga}}</div>
                <div class="stars">
                    <p style="font-size: 15px; display: block;">Jumlah : <span style="color: green;">{{$commer->jumlah}}</span> </p>
                </div>
                <a class="fas fa-shopping-cart" href="{{route('chart', $commer->id)}}"></a>
                <a class="fas fa-eye" href="{{route('screen.product', $commer->id)}}"></a>
                <form  action="{{route('delete', $commer->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <br>
                    <button type="submit" class="fas fa-trash" style="border: 20px solid rgba(255, 0, 0, 0.573); border-radius:20%; font-size:15px;"></button>
                  </form>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    <a href="#" class="btn">read more</a>
</section>

 <!-- about -->
 <section class="about" id="about">
    <h1 class="heading"> <span>about </span> us </h1>
    <div class="row">
        <div class="content">
            <h3>Apa itu wikrama shop?</h3>
            <div class="divider"></div>
            <p>Wikrama shop adalah toko untuk melatih siswa-siswi jurusan bisnis daring dan pemasaran berwirausaha. Tersedia produk-produk pelajar, karya dari semua jurusan yang ada di SMK Wikrama baik itu dalam bentuk produk ataupun jasa.
            </p>
        </div>
        <div class="image">
            <img src="{{asset('assets/img/pmn.jpeg')}}" alt="">
        </div>
    </div>
</section>

<!-- review -->
    <div class="container2"> 
    <div class="testimonial mySwiper">
        <div class="testi-content swiper-wrapper">
            @foreach($feeds as $feed)
          <div class="slide swiper-slide">
            <img src="{{asset('assets/img/'. $feed->file)}}" alt="" class="image" />
            <p>
              {{$feed->description}}
            </p>
            <i class="bx bxs-quote-alt-left quote-icon"></i>

            <div class="details">
              <span class="name">{{$feed->fullname}}</span>
            </div>
          </div>
          @endforeach
        </div>

        <div class="swiper-button-next nav-btn"></div>
        <div class="swiper-button-prev nav-btn"></div>
        <div class="swiper-pagination"></div>
      </div>
  


    <!-- contact -->
    <section class="contact" id="review">
        <h1 class="heading"> Send <span> message </span> </h1>
        <div class="row">
            <form action="{{route('review.input')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="inputBox">
                    <input type="text" name="fullname" placeholder="name">
                    
                    <input type="file"   name="file" placeholder="profile">
                </div>
                <div class="inputBox">
                </div>
                <textarea name="description"  placeholder="message" id="" cols="30" rows="10"></textarea>
                <input type="submit" value="Send Message" class="btn">
            </form>
        </div>
        </div>
    </section>
    <br>  <br>  <br>  <br>


  <!-- footer -->

  <section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>find us here</h3>
            <p>Temukan kami lebih dekat melalui sosial media</p>
            <div class="share">
                <a href="https://www.facebook.com/smkwikrama/" class="fab fa-facebook-f"></a>
                <a href="https://twitter.com/smkwikrama" class="fab fa-twitter"></a>
                <a href="https://www.instagram.com/smkwikrama/?hl=en" class="fab fa-instagram"></a>
                <a href="https://www.linkedin.com/school/smkwikramabogor/" class="fab fa-linkedin"></a>
            </div>
        </div>
        <div class="box">
            <h3>our number</h3>
            <p>0251-8242411</p>
            <a href="prohumasi@smkwikrama.net" class="link">prohumasi@smkwikrama.net</a>
        </div>
        <div class="box">
            <h3>our addres</h3>
            <p>Jl. Raya Wangun<br> Kelurahan Sindangsari<br> Bogor Timur 16720
            </p>
        </div>
    </div>
    <div class="credit">created by <span>kelompok 3 PPLG XI-5</span> all rights reserved!</div>
</section>
<script> var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    grabCursor: true,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
   </script>
@endsection