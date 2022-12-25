@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col col-md-10">
        <nav class="row justify-content-start">
          <ul>
            <a href="{{ route('categories')}}">Catalog /</a>
          </ul>
          <ul>
            <a href="">{{ $category->name }}</a>
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
            <div class="col">
              <img style="display: block; width: auto; height: auto; max-width: 100%; width: 200px" src="/resources/images/categories/{{$category->image}}">
              <div>{{ $category->name }}</div>
              <div>{{ $category->description }}</div>
            </div>
            <div class="panel-heading">Categories</div>
                <h2 class="add-product">Редактировать категорию</h2>
                <form enctype="multipart/form-data" action="{{ route('redactCategory', $category->name) }}" method="POST">
                  @csrf
                  <input style="width: 100%; margin-bottom: 25px;" name="messageText" type='text' placeholder="Введите название категории">
                  <input style="width: 100%; margin-bottom: 25px;" name="image" type='file'><br>
                  <input style="width: 100%; margin-bottom: 25px;" name="description" type='text' placeholder="Введите описание категории"><br>
                  <input type="submit" value="отправить">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection