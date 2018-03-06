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
            {{--  <a href="{{ route('post.create') }}" class="btn btn-primary">Add Post</a>  --}}
            @foreach($posts as $post)
                <div class="panel {{ isset($post->rating) ? $post->rating == "positive" ? 'panel-success' : 'panel-danger' :'panel-default'}}">
                    <div class="panel-heading">
                        Posted by : {{ $post->user->name }}
                   
                        <button type="submit" form="postDelete-{{ $post->post_id }}" class="btn btn-link pull-right">Delete</button>
                        <form action="{{ route('post.destroy', [$post->post_id])}}" method="POST" id="postDelete-{{ $post->post_id }}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </div>

                    <div class="panel-body">
                        {{ str_limit($post->post_content, 100) }}...
                    </div>
                    <div class="panel-footer">
                            <form action="{{ route('post.update', [$post->post_id]) }}" method="POST" id="ratePositive{{$post->post_id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="rating" value="positive">
                            </form>
                            <form action="{{ route('post.update', [$post->post_id]) }}" method="POST" id="rateNegative{{$post->post_id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="rating" value="negative">
                            </form>
                        <div class="btn-group" role="group" aria-label="...">
                        <button type="submit" form="ratePositive{{$post->post_id}}" class="btn btn-success" {{ $post->rating == "positive" ? 'disabled' : '' }}>Positive</button>
                            <button type="submit" form="rateNegative{{$post->post_id}}" class="btn btn-danger" {{ $post->rating == "negative" ? 'disabled' : '' }}>Negative</button>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
