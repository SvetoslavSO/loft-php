@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Categories</div>
              @foreach ($categories as $category)
                  <img style="display: block; width: auto; height: auto; max-width: 100%; width: 200px" src="/resources/images/categories/{{$category->image}}">
                  <a href="{{ route('adminProducts' , $category->name) }}">{{ $category->name }}</a>
              @endforeach
            </div>
            <form enctype="multipart/form-data" action="{{ route('addCategory') }}" method="POST">
                @csrf
                <input style="width: 100%; margin-bottom: 25px;" name="messageText" type='text' placeholder="Введите название категории">
                <input style="width: 100%; margin-bottom: 25px;" name="image" type='file'><br>
                <input style="width: 100%; margin-bottom: 25px;" name="description" type='text' placeholder="Введите описание категории"><br>
                <input type="submit" value="отправить">
            </form>
        </div>
    </div>
</div>
@endsection