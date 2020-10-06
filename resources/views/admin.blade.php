@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1> Pending Loan </h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>                
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingLoans as $loan)
                    <tr>
                        <th scope="row">{{ $loan->id }}</th>
                        <td>{{ $loan->amount }}</td>
                        <td>
                            <button id="action" type="submit" class="btn btn-secondary">{{ $loan->status }}</button>   
                        </td>
                        <td>
                            <form action="{{ route('admin', ['id' => $loan->id]) }}" method="POST">
                                {{ csrf_field() }}
                                <button id="action" type="submit" class="btn btn-primary">APPROVE</button>
                            </form>       
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
