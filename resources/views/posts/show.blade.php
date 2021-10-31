@extends('layout')
{{-- @section('title', 'Posts') --}}
@section('content')
    <table class="table table-striped">
        <thead>
            <th>Column</th>
            <th>Data</th>
        </thead>
        <tbody>
            @foreach ($columns as $column)
            <tr>
                <td>{{ $column }}</td>
                <td>{{ $post[$column] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        
    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @method('DELETE')
        @csrf
        <a class="btn btn-secondary" href="{{ route('posts.index')."?page=".ceil($post->id / 15) }}">go back</a>
        <a class="btn btn-warning" href="{{ route('posts.edit', ['post' => $post->id]) }}">edit</a>
        <input class="btn btn-danger" type="submit" value="delete">
    </form>
@endsection
