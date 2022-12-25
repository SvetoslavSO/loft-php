@extends('layouts.app')

@section('content')
@if($admin)
<div class="container">
    <div class="row">
      <div class="col col-md-10">
        <nav class="row justify-content-start">
          <ul>
            <a href="{{ route('categories') }}">Catalog</a>
          </ul>
        </nav>
      </div>
      <div class="col">
        <a href="{{ route('logout') }}">Выйти</a>
      </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Orders</div>
              <div class="col">
                <table class="table table-bordered">
                  @foreach ($orders as $order)
                    <tr>
                      <td>
                        Id заказа : {{ $order->id }}
                      </td>
                      <td>
                        Email заказчика : {{ $order->email }}
                      </td>
                      <td>
                        Id товара : {{ $order-> product_id }}
                      </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection