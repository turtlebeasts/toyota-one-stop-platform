@extends('layouts.header')


@include('user.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-light">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5">
                    Hello {{ auth()->user()->name }}
                </h3>
                <p class="text-secondary fs-4">Welcome to Toyota one stop platform application</p>
            </div>
        </div>
    </div>
@endsection
