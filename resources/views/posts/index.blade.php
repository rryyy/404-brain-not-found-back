@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h2>All Post</h2>
            <a href="{{ route('post.create') }}" class="btn btn-primary">Add Post</a>
            @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">Posted by : {{ $post->user->name }}</div>

                    <div class="panel-body">
                        {{ str_limit($post->post_content, 100) }}...
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
