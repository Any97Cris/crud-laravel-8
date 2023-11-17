<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>
<body>
    @if ($errors->any())
        <ul>
        @foreach ($errors->all() as $e)
            <li>{{$e}}</li>    
        @endforeach
        </ul>
        
    @endif
    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" id="image">
        <br>
        <input type="text" name="title" id="title" placeholder="Título" value="{{old('title')}}">
        <br>
        <textarea name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
        <br>
        <br>
        <button type="submit">Enviar</button>
        <a href="{{route('post.index')}}">Home</a>
    </form>
</body>
</html>