<?php

	$size_class = '';

	if(isset($size)) {

		switch ($size) {

			case 'sm':
				$size_class = ' btn-sm';
				break;
			case 'md':
				$size_class = ' btn-md';
				break;
			case 'lg':
				$size_class = ' btn-lg';
				break;

		}

	}

?>
@if(isset($route) && !empty($route))
	<?php

		if(!isset($params)) $params = [];

	?>
	{!! link_to_route($route, 'キャンセル', $params, ['class' => 'btn btn-default btn-flat'. $size_class]) !!}&nbsp;
@endif
<button class="btn btn-success btn-flat{!! $size_class !!}" type="submit">{!! $label !!} {!! Camon::glyphicon('circle-arrow-right', [], false) !!}</button>