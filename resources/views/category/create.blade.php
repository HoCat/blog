@extends('layout.default')

@section('title','添加分类')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            @include('shared.error')

            <div class="card-header">
                <h5>添加分类</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('category.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">分类名称：</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                <!--     <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>
 -->
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
@stop
