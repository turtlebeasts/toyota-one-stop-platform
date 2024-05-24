@extends('layouts.header')


@include('admin.navbar')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h6 class="display-6">Customer List</h6>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Customer Details</th>
                                    <th>Vehicle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <b>User: {{ $transaction->user->name }}
                                                ({{ $transaction->user->email }})
                                            </b><br>
                                        </td>
                                        <td>
                                            Vehicle: {{ $transaction->car->name }}<br>
                                            <img src="/storage/{{ $transaction->car->photo }}"
                                                alt="{{ $transaction->car->name }}" class="img-fluid" width="250">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
