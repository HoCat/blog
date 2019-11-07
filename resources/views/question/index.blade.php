@extends('layout.default')
@section('title', '题库')


@section('content')

<div class="box box-info">
	<div class="box-header with-border">
         <h3 class="box-title">分类信息</h3>
     </div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table no-margin">
			  <thead>
			    <tr>
			      <th>编号</th>
			      <th>分类名称</th>
			      <th>操作</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach ($category as $v)
			    <tr>
			      <td><span>{{ $v->id }}</span></td>
			      <td>
			      	<span><a href="{{ route('question_category',$v->id) }}">{{ $v->name }}</a></span>
			      </td>
			      <td>
			      	<span><a href="{{ route('question.create',$v->id) }}">添加试题</a></span>
			      </td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
	</div>
	<div class="box-footer clearfix">
      <a href="{{ route('category.create') }}" class="btn btn-sm btn-default  ">添加分类</a>
    </div>
</div>




@stop