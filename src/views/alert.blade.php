@if(Session::has($level))
	<div class="alert alert-{!! $level !!}{!! ($dismissable) ? ' alert-dismissable' : '' !!}">
		@if($dismissable)
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		@endif
		@if(isset($icons[$level]))
			{!! $icons[$level] !!}
		@endif
		{!! Session::get($level) !!}
	</div>
@endif