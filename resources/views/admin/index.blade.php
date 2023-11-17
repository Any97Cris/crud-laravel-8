<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    @if (session('message'))
        <div>{{session('message')}}</div>
    @endif

    <form action="{{route('post.search')}}" method="POST">
        @csrf
        <input type="text" name="search" placeholder="Filtro">
        <button type="submit">Filtrar</button>
    </form>

    <a href="{{route('post.create')}}">Criar Novo Post</a>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Texto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dados as $d)
            <tr>
                <td>{{$d->title}}</td>
                <td>{{$d->content}}</td>
                <td>
                    <img src="{{ url("storage/{$d->image}") }}" alt="imagem" style="max-width:100px">
                    <a href="{{route('post.show', $d->id)}}">Ver</a>
                    <a href="{{route('post.edit', $d->id)}}">Editar</a>
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
    @if (isset($filters))
        {{$dados->appends($filters)->links()}}
    @else
        {{$dados->links()}}
    @endif
</body>
</html>