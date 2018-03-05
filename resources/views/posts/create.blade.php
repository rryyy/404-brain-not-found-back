@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Create New Post</h2>
                <form method="POST" action="{{ route('post.store') }}">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="post_content" id="" cols="30" rows="10" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Feeling</label>
                            <select name="feeling" id="" class="form-control">
                                <option value="sad">Sad</option>
                                <option value="angry">Angry</option>
                                <option value="happy">Happy</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>PUVS</label>
                            <select name="puv" id="" class="form-control">
                                <option value="bus">BUS</option>
                                <option value="bus">BUS</option>
                                <option value="bus">BUS</option>
                                <option value="bus">BUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('post.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection