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
          <a href="{{ route('products' , $category) }}">{{ $category }} /</a>
        </ul>
        <ul>
          <a class="disabled" href="">{{ $product[0]['name'] }}</a>
        </ul>
      </nav>
      </div>
      <div class="col">
        <a href="{{ route('logout') }}">Выйти</a>
      </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('buyProduct', [ $category, $product[0]['name']])}}">
              <div class="panel panel-default">
                <div class="panel-heading">Product</div>
              </div>
              <div class="photo">
                <img style="display: block; width: auto; height: auto; max-width: 100%; width: 200px" src="/resources/images/products/{{$product[0]['photo']}}">
              </div>
              <div class="name">
                Название: {{$product[0]['name']}}
              </div>
              <div class="desc">
                Описание: {{$product[0]['description']}}
              </div>
              <div class="price">
                Цена: {{$product[0]['price']}}
              </div>
              <button type="submit">Купить</button>
            </form>
            @if ($admin)
              <form action="{{ route('deleteProduct', [ $category, $product[0]['name']])}}">
                <button type="submit">Удалить</button>
              </form>
            @endif
            @if ($admin)
              <h2 class="add-product">Редактировать товар</h2>
              <form enctype="multipart/form-data" action="{{ route('redactProduct', [ $category, $product[0]['name']])}}" method="POST">
                  @csrf
                  <input style="width: 100%; margin-bottom: 25px;" name="messageText" type='text' placeholder="Введите название товара">
                  <input style="width: 100%; margin-bottom: 25px;" name="photo" type='file'><br>
                  <input style="width: 100%; margin-bottom: 25px;" name="description" type='text' placeholder="Введите описание товара"><br>
                  <input style="width: 100%; margin-bottom: 25px;" name="price" type='text' placeholder="Введите цену товара"><br>
                  <input type="submit" value="отправить">
              </form>
            @endif
        </div>
    </div>
</div>
@endsection