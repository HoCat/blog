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
                <form method="POST" action="{{ route('question.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="content">试题内容：</label>
                        <input type="text" name="content" class="form-control" value="{{ old('content') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">试题分类：</label>
                        <select class="custom-select" name="category_id">
                          @foreach ($data['category'] as $cate)   
                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                          @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="name">试题类型：</label>
                        <select class="custom-select" name="type">
                          @foreach ($data['types'] as $type)   
                            <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">试题参数：</label>
                        <input type="text" name="param" class="form-control" value="{{ old('param') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">试题答案：</label>

                       <!--  <input type="text" name="answer" class="form-control" value=""> -->
                        <textarea name="answer" class="form-control" rows="3">{{ old('answer') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
@stop
