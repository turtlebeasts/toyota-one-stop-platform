@extends('layouts.header')


@include('admin.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-light">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5">
                    Welcome {{ auth()->user()->name }}
                </h3>
                <p>From here you can manage your website work flow</p>
            </div>
        </div>
    </div>
@endsection
