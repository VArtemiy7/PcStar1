@extends('layouts.app')

@section('content')
    <div class="about-container text-center py-4">
        <h1 class="fade-out" style="font-size: 3.5rem; margin-bottom: 0.5rem;">PC_Star</h1>
        <span style="font-size: 1.2rem; display: block; max-width: 800px; margin: 0 auto; padding: 15px 20px;">
            Добро пожаловать на сайт PC_Star! Мы — компания, которая занимается продажей мощных игровых и рабочих станций. Если вам нужна надёжная техника для игр или работы, мы будем рады помочь вам с выбором.
        </span>
    </div>

    <div id="carouselExampleDark" class="carousel carousel-dark slide" style="max-width: 900px; margin: 0 auto;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner rounded-3">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="{{asset("images/PCi5-12400fandrtx-3050.webp")}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="{{asset("images/PCi5-13400fandrtx-3060.webp")}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset("images/PCi7-12700kfandrtx3070ti.webp")}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset("images/PCi9-14900kandrtx4070ti-super.webp")}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection