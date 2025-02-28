@extends('layouts.default')
@section('title', 'E-Commerce - Home')
@section('content')
    <main class="container" style="max-width: 900px">
        <section>
            <img src="{{ $products->image }}" alt="{{ $products->title }}" style="width: 100%" class="mb-3">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <h1>{{ $products->title }}</h1>
            <span>$ {{ $products->price }}</span>
            <p>{{ $products->description }}</p>
            <a href="{{ route('cart.add', $products->id)}}" class="btn btn-success">Add to cart</a>
        </section>
    </main>
@endsection
