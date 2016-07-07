@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All Transactions</div>

                <div class="panel-body">
                    @if(session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          @if($isAdmin)
                            <th>User</th>
                          @endif
                          <th>Amount</th>
                          <th>Created</th>
                          <th>Approved</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transactions as $transaction)
                          <tr>
                            @if($isAdmin)
                              <td>{{ $transaction->creator->name }}</td>
                            @endif
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->created_at->diffForHumans() }}</td>
                            <td>
                              @if($transaction->approved)
                                <i class="glyphicon glyphicon-ok"></i>
                              @else
                                <i class="glyphicon glyphicon-remove"></i>
                              @endif

                              @if($isAdmin)
                                <ul class="list-inline">
                                  @if(!$transaction->approved)
                                    <li>
                                      <a href="/loan/{{$transaction->id}}/approve" class="btn btn-success">Approve</a>
                                    </li>
                                  @endif
                                  <li>
                                    <a href="/loan/{{$transaction->id}}/delete" class="btn btn-danger">Delete</a>
                                  </li>
                                </ul>
                              @endif
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