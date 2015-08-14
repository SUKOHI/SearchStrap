<form id="search-strap-form">
	<div class="input-group">
		<div class="input-group-btn">
			<button type="button" class="btn btn-{!! $color_types['filter'] !!} dropdown-toggle" data-toggle="dropdown">
				<?php

				$filter_title = $filters[$default_filter_key];

				foreach($filters as $key => $filter) {

					if(Request::has($key)) {

						$filter_title = $filter;
						$default_filter_key = $key;

					}

				}

				$dropdown_value = '';

				if(isset($dropdown_data[$default_filter_key])) {

					$keyword = '';
					$dropdown_value = Request::input($default_filter_key);

				}

				?>
				<span id="search_title">{!! $filter_title !!}</span> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				@foreach($filters as $key => $filter)
					<li><a href="#{!! $key !!}"><i class="fa fa-angle-double-right"></i> {!! $filter !!}</a></li>
				@endforeach
			</ul>
		</div>
		<input type="hidden" name="search_param" value="{!! $default_filter_key !!}" id="search_param" data-dropdowns="{!! (isset($dropdown_data)) ? implode(',', array_keys($dropdown_data)) : '' !!}">
		<span id="search_key_block">
			<input
				type="text"
				class="form-control"
				placeholder="{!! $placeholder !!}"
				id="search_key"
				value="{!! (isset($keyword) ? $keyword : '') !!}"
				style="{!! (isset($dropdown_data[$default_filter_key])) ? 'display:none;' : '' !!}">
		</span>
		@if(isset($dropdown_data))
			@foreach($dropdown_data as $key => $dropdown_values)
				{!! FormStrap::select(
					$key,
					$dropdown_values,
					($key == $default_filter_key) ? $dropdown_value : '',
					[
						'id' => 'search_key_'. $key,
						'style' => ($key == $default_filter_key) ? '' : 'display:none;'
					]
				)->css('group', 'search-strap-dropdown') !!}
			@endforeach
		@endif
		<span class="input-group-btn">
		@if(!empty(Request::getQueryString()))
			<a class="btn btn-default btn-md text-muted" href="{!! Request::url() !!}" title="clear">&thinsp;<i class="fa fa-times"></i>&thinsp;</a>
		@endif
			<button class="btn btn-{!! $color_types['button'] !!}" type="submit">{!! $button_label !!}</button>
		</span>
	</div>
</form>