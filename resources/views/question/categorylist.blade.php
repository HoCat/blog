@extends('layout.default')
@section('title', '题库')


@section('content')

<div class="box box-info">
	<div class="box-body">
	<div class="question-detail">
		@foreach ($data as $val)
		<div class="detail-content">
			<div class="timu">
			<p class="timu-text">{{ $val->id }}/{{ $data->total() }}、{{ $val->content }}：</p>
		<!-- 	<button class="btn-shoucang " ref="shoucang">收藏</button> -->
			</div>
			<div class="answer clearfix">
				@switch($val->type)
				          @case(1)
				            <div data-questionid="{{ $val->id }}" class="options left">
								<p>A、违规行为</p>
								<p>B、违法行为</p>
								<p>C、违章行为</p>
								<p>D、过失行为</p>
							</div>
				          @break;
				          @case(2)
				          @case(3)
				          @break;

				          @default
				               
				@endswitch
				
			</div>
		</div>
		@endforeach
	</div>

	
</div>
</div>
<div class="btn-bar clearfix">

		@if ($data->onFirstPage())

		@else
		<a href="{{ $data->previousPageUrl() }}"><button type="button"  class="btn btn-default">上一题</button></a>
        @endif

		@if ($data->hasMorePages())
            <a href="{{ $data->nextPageUrl() }}"><button type="button"  class="btn btn-default">下一题</button></a>
        @endif
		
		<a class="get-answer" href="javascript:;"><button type="button" class="btn btn-default">显示答案</button></a>
</div>

@stop