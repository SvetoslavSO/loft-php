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
          <a href="{{ route('toProduct' , [ $category, $product[0]['name']]) }}">{{ $product[0]['name'] }} /</a>
        </ul>
        <ul>
          <a class="disabled" href="">{{ $product[0]['name'] }} buy</a>
        </ul>
      </nav>
      </div>
      <div class="col">
        <a href="{{ route('logout') }}">Выйти</a>
      </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (!$user->admin)
              Оставьте нам контактные данные
              <form action="{{ route('confirmBuy', [$category, $product[0]['id']])}}" method="POST">
                <div class="col">
                  @csrf
                  <input class="row mb-2" type="text" name="email" value="{{$user->email}}">
                  <input class="row mb-2" type="text" name="name" placeholder="Введите своё имя">
                  <button class="row mb-2" type="submit">Отправить</button>
                </div>
              </form>
              <form>
                <div>
                  Товар
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
              </form>
            @endif
        </div>
    </div>
</div>
@endsection