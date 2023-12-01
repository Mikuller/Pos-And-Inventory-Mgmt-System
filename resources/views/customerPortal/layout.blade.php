<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | Radmin - Laravel Admin Starter</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')
	
</head>
<body id="app" >
    <div class="container-fluid vw-100 bg-light">
    	
    	<div>
			
	    	{{-- <!-- initiate sidebar-->
	    	@include('customerPortal.service-info') --}}
	    	
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	

	    	<!-- initiate footer section-->
	    	

    	</div>
		@include('include.footer')
    </div>
    
		<!-- initiate scripts-->
	@include('include.script')	
</body>
</html>