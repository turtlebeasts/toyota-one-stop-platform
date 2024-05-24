@extends('layouts.header')


@include('user.navbar')
@section('content')
    <div class="container bg-light mt-5 py-5">
        <div class="row">
            <div class="col-12">
                <h3>Your cart</h3>
                @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                @endif
                @if ($cart->isEmpty())
                    <div class="alert alert-primary">
                        <i class="bi bi-exclamation-circle"></i> Your cart is empty
                    </div>
                @else
                    <div class="alert alert-primary">
                        Total cart items: {{ sizeof($cart) }}<br>
                        @php
                            $total = 0;
                            if (sizeof($cart) > 0) {
                                foreach ($cart as $key => $c) {
                                    $total += $c->part->price;
                                }
                                echo "Total price: $ " . $total;
                            }
                        @endphp
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if ($cart->isNotEmpty())
                @foreach ($cart as $cart)
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6>{{ $cart->part->name }}</h6>
                                <img src="/storage/{{ $cart->part->photo }}" alt="" class="img-fluid"><br>
                                <b>$ {{ $cart->part->price }}</b><br>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger mt-2 btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-{{ $cart->id }}">
                                    Remove item
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{ $cart->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Item</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to remove this item?<br>
                                                <img src="/storage/{{ $cart->part->photo }}" alt="{{ $cart->part->name }}"
                                                    class="img-fluid"><br>
                                                <b>{{ $cart->part->name }}</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('part_cart.remove', $cart->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
