@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h3>Your Details</h3>

                    @if(session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                      <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Loan Amount</th>
                      </thead>
                      <tbody>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->amount }}</td>
                      </tbody>
                    </table>
                    <div class="row">
                      @if($user->amount == 0)
                        <div class="col-md-6">
                          <h4>Get Loan</h4>
                          <form method="POST" action="/getLoan">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label>Loan Amount</label>
                              <input name="amount" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                              <input type="submit" class="btn btn-success">
                            </div>
                          </form>
                        </div>
                      @endif
                      @if($user->amount > 0)
                        <div class="col-md-6">
                          <h4>Pay Loan</h4>
                          <form method="POST" action="/payLoan">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label>Loan Amount</label>
                              <input name="amount" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                              <input type="submit" class="btn btn-success">
                            </div>
                          </form>
                        </div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
