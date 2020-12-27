@extends('layouts.app')

@section('content')
    <div class="container">
        <section>
            <div class="card text-center">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="{{route('products.index')}}" class="btn btn-primary">all product</a>
                </div>
            </div>
        </section>

        <section style="margin: 30px">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset($product->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-text">{{$product->price}}</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
