@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Products</div>
              @foreach ($products as $product)
                  <img style="display: block; width: auto; height: auto; max-width: 100%; width: 200px" src="/resources/images/products/{{$product->photo}}">
              @endforeach
            </div>
            <form enctype="multipart/form-data" action="{{ route('addProduct', $category)}}" method="POST">
                @csrf
                <input style="width: 100%; margin-bottom: 25px;" name="messageText" type='text' placeholder="Введите название товара">
                <input style="width: 100%; margin-bottom: 25px;" name="image" type='file'><br>
                <input style="width: 100%; margin-bottom: 25px;" name="description" type='text' placeholder="Введите описание товара"><br>
                <input style="width: 100%; margin-bottom: 25px;" name="price" type='text' placeholder="Введите цену товара"><br>
                <input type="submit" value="отправить">
            </form>
        </div>
    </div>
</div>
@endsection