@extends('layout.default')

@section('content')
    <div class="jumbotron" style="background-image: url({{getRandImage()}});background-size: 33%;" >
       
        <h1>{{ getSlogan() }},
             @if(Auth::check())
             {{ Auth::user()->name }}
             @else
              Tourist
             @endif
         </h1>
        <p>
            @if(Auth::check())
                <div class="prompt">
                    <h3>What is your main focus for today?</h3>
                </div>
            @else
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
            @endif
        </p>
       
    </div>
    @if(Auth::check())
     <div class="row">
          <div class="col-md-8">
            <section class="status_form">
              @include('shared._status_form', ['user' => Auth::user()])
            </section>
            <h4>微博列表</h4>
            <hr>
            @include('shared._feed')
          </div>
          <aside class="col-md-4">
            <section class="user_info">
              @include('shared.user_info', ['user' => Auth::user()])
            </section>
            <section class="stats mt-2">
             
            </section>
          </aside>
        </div>
     @endif   

@stop

