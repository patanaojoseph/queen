@extends('layouts.home_master')
    @php
        $services = DB::table('services')->get();
    @endphp
@section('home_content')
<section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Services</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Services</li>
          </ol>
        </div>

      </div>
    </section>

<section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</strong></h2>
          <p>Laborum repudiandae omnis voluptatum consequatur mollitia ea est voluptas ut</p>
        </div>

        <div class="row">
            @foreach ($services as $key => $service)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box iconbox-blue">
                <div class="icon">

                    <i class="{{ $key == 0 ? '$service->icon' : '' }}"></i>
                </div>
                <h4><a href="">{{ $service->title }}</a></h4>
                <p>{{ $service->description }}</p>
                </div>
            </div>
          @endforeach

        </div>

      </div>
    </section>

@endsection
