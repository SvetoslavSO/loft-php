@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col col-md-10">
        <nav class="row">
          <ul>
            <a href="{{ route('categories') }}">Catalog /</a>
          </ul>
          <ul>
            <a href="">{{ $category }}</a>
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
            <div class="panel-heading">Products</div>
              <div class="row row-cols-3">
                @foreach ($products as $product)
                      <div class="col">
                        <img style="display: block; width: auto; height: auto; max-width: 100%; width: 200px" src="/resources/images/products/{{$product->photo}}">
                        <a href="{{ route('toProduct', [$category, $product->name])}}">{{ $product->name}}</a>
                      </div>
                @endforeach
              </div>
            </div>
            @if ($admin)
              <h2 class="add-product">Добавьте товар</h2>
              <form enctype="multipart/form-data" action="{{ route('addProduct', $category)}}" method="POST">
                  @csrf
                  <input style="width: 100%; margin-bottom: 25px;" name="messageText" type='text' placeholder="Введите название товара">
                  <input style="width: 100%; margin-bottom: 25px;" name="image" type='file'><br>
                  <input style="width: 100%; margin-bottom: 25px;" name="description" type='text' placeholder="Введите описание товара"><br>
                  <input style="width: 100%; margin-bottom: 25px;" name="price" type='text' placeholder="Введите цену товара"><br>
                  <input type="submit" value="отправить">
              </form>
            @endif
        </div>
    </div>
</div>
@endsection