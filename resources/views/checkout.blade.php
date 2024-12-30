@extends('layouts.default')
@section('title', 'Checkout')
@section('content')
    <main class="container" style="max-width: 900px">
        <section>
            <h2>Checkout</h2>
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
            <form action="{{route('checkout.show')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="pincode" class="form-label">Pincode</label>
                    <input type="text" class="form-control" id="pincode" name="pincode" required>
                </div>
                <button type="submit" class="btn btn-primary">Process to payment</button>
            </form>
        </section>
    </main>
@endsection