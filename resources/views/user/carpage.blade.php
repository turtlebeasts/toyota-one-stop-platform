@extends('layouts.header')


@include('user.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-white px-5">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->all())
                    <ul class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-sm-12 col-md-6">
                <img src="/storage/{{ $car->photo }}" alt="{{ $car->name }}" class="img-fluid">
                @if ($car->feedbacks->isEmpty())
                    <p>No rating posted for this car</p>
                @else
                    <h4>User reviews</h4>
                    @foreach ($car->feedbacks as $feedback)
                        <div class="card mt-2">
                            <div class="card-body">
                                <b><i class="bi bi-person-circle"></i> {{ $feedback->user->email }}</b>
                                <h6></h6>
                                <p>
                                    <span class="badge text-bg-secondary">
                                        {{ $feedback->rating }}
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    {{ $feedback->message }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-12 col-md-6">
                <h1 class="display-3">{{ $car->name }} </h1>
                <h4 class="text-secondary">{{ $car->color }}</h4>
                <br>
                <p class="fs-3 text-danger">$ {{ $car->price }}</p>
                <b>Built-model: {{ $car->year }}</b>
                <p>{{ $car->description }}</p>

                @if ($car->stock > 0)
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addToCart">
                        Add to cart
                    </button>

                    <div class="modal fade" id="addToCart" tabindex="-1" aria-labelledby="addToCartLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addToCartLabel">Add to cart</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h1 class="display-3">{{ $car->name }}</h1>
                                    <h4 class="text-secondary">{{ $car->color }}</h4>
                                    <p>Add these to cart?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="{{ route('user.cart', $car->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <button disabled="disabled" class="btn btn-dark">Add to cart</button>
                    <p class="text-danger">This vehicle is out of stock</p>
                @endif
                <!-- Button trigger modal -->

                <!-- Modal -->

                @if (auth()->user()->cars->contains($car->id))
                    <div class="col-sm-12 col-md-6 mt-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form action="{{ route('user.feedback', $car->id) }}" method="post">
                                    @csrf
                                    <h4>Add your feed back</h4>
                                    <label for="rating">Rating</label>
                                    <input type="number" name="rating" class="form-control mt-2" id="rating"
                                        min="1" max="5">
                                    <label for="message">Your message</label>
                                    <textarea name="message" class="form-control mt-2" id="message" cols="10" rows="3"
                                        placeholder="Your message"></textarea>
                                    <button type="submit" class="btn btn-dark mt-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
