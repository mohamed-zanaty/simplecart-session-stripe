@extends('layouts.app')

@section('content')
    <div class="container">

        <section style="margin: 30px">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset($product->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-text">{{$product->price}}</p>
                                <a href="{{route('add', $product->id)}}" class="btn btn-primary">add to cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
