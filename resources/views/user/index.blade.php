@extends('layout.default')

@section('title','用户列表')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel-heading">
            <h5>用户列表</h5>
        </div>
        <ul class="users">
            @foreach ($users as $user)
                @include('user.center')
            @endforeach
        </ul>
        {!! $users->render() !!}
    </div>
@stop