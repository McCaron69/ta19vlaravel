@extends('layout')
@section('title', 'User posts')
@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col">
                <div class="p-3 border bg-light">Total posts: {{ $posts->count() }}</div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">Total likes: {{ $likes_total }}</div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">Total comments: {{ $comments_total }}</div>
            </div>
        </div>
    </div>
    @if ($posts->empty())
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Likes</th>
                <th scope="col">Comments</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
            @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->likes()->count() }}</td>
                        <td>{{ $post->comments()->count() }}</td>
                        <td><a href="/posts/{{ $post->id }}" class="btn btn-primary">View</a></td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div>You have no posts.</div>
    @endif
    {{ $posts->links() }}
@endsection
