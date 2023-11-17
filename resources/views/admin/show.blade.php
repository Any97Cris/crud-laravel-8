<h1>Detalhes do Post {{$post->title}}</h1>

<ul>
    <li>{{$post->title}}</li>
    <li>{{$post->content}}</li>
</ul>

<br>
<hr>
<a href="{{route('post.index')}}">Home</a>

<form action="{{route('post.delete', $post->id)}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit">Deletar Post {{$post->title}}</button>
</form>