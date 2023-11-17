<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar</title>
</head>
<body>
    @if ($errors->any())
        <ul>
        @foreach ($errors->all() as $e)
            <li>{{$e}}</li>    
        @endforeach
        </ul>
        
    @endif
    <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <input type="file" name="image" id="image" value="{{$post->image ? $post->image : old('image')}}">
        <br>
        <input type="text" name="title" id="title" value="{{$post->title ? $post->title : old('title')}}">
        <br>
        <textarea name="content" id="content" cols="30" rows="10">{{$post->content ? $post->content : old('content')}}</textarea>
        <br>
        <br>
        <button type="submit">Enviar</button>
        <a href="{{route('post.index')}}">Home</a>
    </form>
</body>
</html>