@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col col-md-10">
        <nav class="row justify-content-start">
          <ul>
            <a href="">Catalog</a>
          </ul>
        </nav>
      </div>
      <div class="col">
        <a href="{{ route('toOrders') }}">К заказам</a>
        <a href="{{ route('logout') }}">Выйти</a>
      </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Categories</div>
              <div class="row row-cols-3">
                @foreach ($categories as $category)
                      <div class="col">
                        <img style="display: block; width: auto; height: auto; max-width: 100%; width: 200px" src="/resources/images/categories/{{$category->image}}">
                        <a href="{{ route('products' , $category->name) }}">{{ $category->name }}</a>
                        @if ($admin)
                          <form action="{{route('goToRedactCategory', $category->name)}}">
                            <button type="submit">Редактировать категорию</button>
                          </form>
                        @endif
                        @if ($admin)
                          <form action="{{route('deleteCategory', $category->name)}}">
                            <button type="submit">Удалить категорию</button>
                          </form>
                        @endif
                      </div>
                @endforeach
              </div>
              @if ($admin)
                <h2 class="add-product">Добавьте категорию</h2>
                <form enctype="multipart/form-data" action="{{ route('addCategory') }}" method="POST">
                  @csrf
                  <input style="width: 100%; margin-bottom: 25px;" name="messageText" type='text' placeholder="Введите название категории">
                  <input style="width: 100%; margin-bottom: 25px;" name="image" type='file'><br>
                  <input style="width: 100%; margin-bottom: 25px;" name="description" type='text' placeholder="Введите описание категории"><br>
                  <input type="submit" value="отправить">
                </form>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection