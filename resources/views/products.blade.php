@extends('layouts.default')
@section('title', 'E-Commerce - Home')
@section('content')
    <main class="container" style="max-width: 900px">
        <section>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-12 col-md-6 col-lg-3 ">
                    <div class="card shadow-sm p-3">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}" style="width: 100%">
                        <div><a href="{{ route('products.details', $product->slug)}}">{{ $product->title }}</a> | <span>$ {{ $product->price }}</span></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                {{$products->links()}}
            </div>
        </section>
    </main>
@endsection
