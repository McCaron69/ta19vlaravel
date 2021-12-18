@extends('layout')
@section('title', 'User posts')
@section('content')
    <h1 class="pt-5">{{ $user->name }} (ID: {{ $user->id }}) statistics</h1>
    <div class="pt-4 pb-4">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Likes given: {{ $likes_given }}</td>
                    <td>Comments written: {{ $comments_written }}</td>
                    <td>Posts written: {{ $posts_written }}</td>
                </tr>
                <tr>
                    <td colspan=2>Likes on posts gained: {{ $likes_gained }}</td>
                    <td>Comments on posts gained: {{ $comments_gained }}</td>
                </tr>
            </tbody>
        </table>
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
