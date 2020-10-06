@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Submit a loan</h2>
                    <p>This is a Loan with 12 months recurrence with rate 1% per week</p>
                </div>
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('home') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('agree') ? ' has-error' : '' }}">
                            <label for="agree" class="col-md-4 control-label">Agree</label>
                            <div class="col-md-1">
                                <input id="agree" type="checkbox" class="form-control" name="agree" value="{{ old('agree') }}" required autofocus>

                                @if ($errors->has('agree'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('agree') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        <div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h1> Payment Loan </h1>
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
                @foreach ($paymentLoans as $loan)
                    @if($loan->total_income < $loan->amount && $loan->total_income !== $loan->amount)
                        <tr>
                            <th scope="row">{{ $loan->id }}</th>
                            <td>{{ $loan->amount }}</td>
                            <td><button id="action" type="submit" class="btn btn-success">{{ $loan->status }}</button></td>
                            <td>
                                <form action="{{ route('pay', ['id' => $loan->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button id="action" type="submit" class="btn btn-primary">Pay</button>
                                </form>   
                            </td>    
                        </tr>
                    @endif    
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <h1> Pending Loan </h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingLoans as $loan)
                    <tr>
                        <th scope="row">{{ $loan->id }}</th>
                        <td>{{ $loan->amount }}</td>
                        <td><button id="action" type="submit" class="btn btn-secondary">{{ $loan->status }}</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
