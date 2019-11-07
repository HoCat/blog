@extend('layout.default')
@section('title', '新闻')

@section('content')
	<div id="app">
	    <nav class="navbar navbar-inverse">
	      <div class=" container">
	         <div class="navbar-header">
	            <a class="navbar-brand" href="/">LaravelVue</a>
	        </div>
	      </div>
	    </nav>    
    <div class="container main">
      <router-view />
    </div>
  </div>
@stop