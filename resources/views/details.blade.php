@extends('layouts.default')
@section('title', 'E-Commerce - Home')
@section('content')
    <main class="container" style="max-width: 900px">
        <section>
            <img src="{{ $products->image }}" alt="{{ $products->title }}" style="width: 100%">
            <h1>{{ $products->title }}</h1>
            <span>$ {{ $products->price }}</span>
            <p>{{ $products->description }}</p>
        </section>
    </main>
@endsection
