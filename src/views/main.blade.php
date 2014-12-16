@if($submit_flag)
	@if($cancel_position == 'left')
		{{ HTML::link($url, $text, $cancel_options) }}
	@endif
		{{ Form::button($value, $options) }}
	@if($cancel_position == 'right')
		{{ HTML::link($url, $text, $cancel_options) }}
	@endif
@else
<div class="{{ (!empty($group_class)) ? $group_class : 'form-group' }}{{ $errors->has($name) ? ' has-error': '' }}">
	@if(!empty($label))
		@if(isset($icons['left']) || isset($icons['right']))
		<?php 
			$replacement = '__LABEL_REPLACEMENT__';
			$label_with_icons = '';
			$label_with_icons .= (isset($icons['left'])) ? $icons['left'] : '';
			$label_with_icons .= $label;
			$label_with_icons .= (isset($icons['right'])) ? $icons['right'] : '';
			$label_tag = (string) Form::label($name, $replacement, $label_options);
			echo str_replace($replacement, $label_with_icons, $label_tag);
		?>
		@else
			{{ Form::label($name, $label, $label_options) }}
		@endif
	@endif
	<div{{ !empty($content_class) ? ' class="'. $content_class .'"' : '' }}>
	@if(!empty($view))
		@include($view, $options)
	@else
		@if($type == 'text')
			{{ Form::text($name, $value, $options) }}
		@elseif($type == 'password')
			{{ Form::password($name, $options) }}
		@elseif($type == 'textarea')
			{{ Form::textarea($name, $value, $options) }}
		@elseif($type == 'radio')
			<?php 
				$index = 0;
				$rendors = array();
				foreach($values as $value => $label) {
				
					$options['id'] = $name .'_'. $index;
					$rendors[] = Form::radio($name, $value, ($value == $checked_values[0]), $options)
					. Form::label($options['id'], $label, $options);
					$index++;
				
				}
			?>
			{{ implode($separator, $rendors) }}
		@elseif($type == 'checkbox')
			<?php 
				$index = 0;
				$rendors = array();
				$checkbox_name = (count($values) == 1) ? $name : $name .'[]';
				foreach($values as $value => $label) {
				
					$options['id'] = $name .'_'. $index;
					$rendors[] = Form::checkbox($checkbox_name, $value, (in_array($value, $checked_values)), $options)
									. Form::label($options['id'], $label, $options);
					$index++;
				
				}
			?>
			{{ implode($separator, $rendors) }}
		@elseif($type == 'select')
			{{ Form::select($name, $values, $checked_values[0], $options) }}
		@elseif($type == 'file')
			{{ Form::file($name, $options) }}
		@elseif($type == 'hidden')
			@foreach($values as $value => $name)
				{{ Form::hidden($value, $name) }}
			@endforeach
		@endif
	@endif
	</div>
	@if($errors->has($name))
		<div class="text-danger">{{ $errors->first($name) }}</div>
	@endif
</div>
@endif