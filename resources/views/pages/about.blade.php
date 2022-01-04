@extends('layouts.home_master')

    @php
        $abouts = DB::table('abouts')->get();
    @endphp

@section('home_content')
<section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>About</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>About</li>
          </ol>
        </div>

      </div>
    </section>


<section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</strong></h2>
        </div>

        @foreach ($abouts as $about)
        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right">
            <h2>{{ $about->title }}</h2>
            <h3>{{ $about->short_description }}</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
            <p>{{ $about->long_description }}</p>
            <p class="font-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
          </div>
        </div>
        @endforeach

      </div>
    </section><!-- End About Us Section -->


@endsection
