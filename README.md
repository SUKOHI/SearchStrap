FormStrap
====

A PHP package mainly developed for Laravel to generate form input tags of Bootstrap that can automatically display errors, labels and alerts.  
(This is for Laravel 5+. [For Laravel 4.2](https://github.com/SUKOHI/FormStrap/tree/1.0))

Installation
====

Add this package name in composer.json

    "require": {
      "sukohi/form-strap": "2.*"
    }

Execute composer command.

    composer update

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        Sukohi\FormStrap\FormStrapServiceProvider::class,
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'FormStrap'   => Sukohi\FormStrap\Facades\FormStrap::class
    ]

Requirements
====

* [laravelcollective/html 5.0+](http://laravelcollective.com/docs/5.1/html)  
* [BootStrap](http://getbootstrap.com/)

Usage(with blade)
====
**Text**  

    {!! \FormStrap::text('name_1', 'text') !!}
    
    
**Label**

    {!! \FormStrap::text('name_2', 'text')->label('LABEL_1') !!}
				
    {!! \FormStrap::text('name_3', 'text')->label('LABEL_2', ['class' => 'text-danger']) !!}
				
    {!! \FormStrap::text('name_4', 'text')->label('LABEL_3')->icon('<i class="fa fa-home"></i>', 'left') !!}
    
**Password**

    {!! \FormStrap::password('name_9', $options = []) !!}
    
**Textarea**

    {!! \FormStrap::textarea('name_10', 'Text', $options = []) !!}
    
**Radio Button(s)**

    {!! \FormStrap::radio('name_11', ['value' => 'label'], 'checked_value', $options = []) !!}
			
    {!! \FormStrap::radio('name_12', [
    		'value_1' => 'label_1', 
    		'value_2' => 'label_2', 
    		'value_3' => 'label_3'
    	], 'checked_value', $options = [], $separator = '&nbsp;') !!}
				
**Checkbox(es)**

    {!! \FormStrap::checkbox('name_13', ['value' => 'label'], ['checked_value'], $options = []) !!}
				
    {!! \FormStrap::checkbox('name_14', [
		'value_1' => 'label_1', 
		'value_2' => 'label_2', 
		'value_3' => 'label_3'
	], [
		'checked_value_1', 
		'checked_value_2'
	], $options = [], $separator = '&nbsp;') !!}
	
**Select**

    {!! \FormStrap::select('name_15', [
		'' => '', 
		'value_1' => 'label_1', 
		'value_2' => 'label_2', 
		'value_3' => 'label_3'
	], 'selected_value', $options = []) !!}
	
    {!! \FormStrap::select('name_15_2', [
        '' => '',
        'value_1' => 'label_1',
        'value_2' => 'label_2',
        'value_3' => 'label_3'
    ], 'selected_value', $options = [], $redirect_url = 'http://example.com/{selected_value}') !!}

* When setting $redirect_url, the select box has "onchange" event to redirect the url.
* {selected_value} will be replaced with the value you selected.  
  
  
**File**

    {!! \FormStrap::file('name_16', $options = []) !!}
	
    {!! \FormStrap::file('name_17')->multiple() !!}
	
    {!! \FormStrap::file('name_18')->accept('image/*') !!}
	
**Hidden(s)**

	{!! \FormStrap::hidden([
		'name_19' => 'value_1', 
		'name_20' => 'value_2', 
		'name_21' => 'value_3'
	]) !!}
	
**Custom view**

    {!! \FormStrap::view('name_22', 'custom.view', $parameters = []) !!}
    
**Submit**

    {!! \FormStrap::submit('Submit <i class="fa fa-home"></i>', ['class' => 'btn btn-success btn-sm']) !!}
    
    {!! \FormStrap::submit('Submit', ['class' => 'btn btn-success btn-sm'])
			->cancel('url', 'CANCEL', ['class' => 'btn btn-default btn-sm']) !!}
	
    {!! \FormStrap::submit('Submit')->cancel('url')->right() !!}
    
**Attribute Names for Validation (hidden tags)**  

    {!! \FormStrap::attributeNames($key = 'attribute_names') !!}
    
     or you can add/overwrite attributes using array.
    
    {!! \FormStrap::attributeNames('attribute_names', [
        'attribute_1' => 'value_1', 
        'attribute_2' => 'value_2',
        'attribute_3' => 'value_3'
    ]) !!}
    
and then in controller
    
    $validator->setAttributeNames(Request::input('attribute_names'))

**Option Labels**  
  
This way is to get selected labels of radio buttons, checkboxes and selectbox.  
At first, set the following to generate hidden-tags in View.

    {!! \FormStrap::optionLabels() !!}

    // or you can use custom name with additional values

    {!! \FormStrap::optionLabels('custom_hidden_name', [
	    'key' => ['1' => 'value_1', '2' => 'value_2']
	]) !!}

and then 


    $option_labels = \FormStrap::selectedOptionLabels('key');
   
   

**Alert**

When redirecting like this.

    return back()->with('danger', 'Error occured!');
    
and then

    {!! \FormStrap::alert('danger') !!}
    {!! \FormStrap::alert('warning') !!}
    {!! \FormStrap::alert('info', $dismissable = true) !!}
    {!! \FormStrap::alert('success', false) !!}
    
    // If you'd like to add icon(s)
    
    {!! \FormStrap::alert()->icons([

    	'danger' => '<i class="fa fa-***"></i> ', 
    	'warning' => '<i class="fa fa-***"></i> ', 
    	'primary' => '<i class="fa fa-***"></i> ', 
    	'info' => '<i class="fa fa-***"></i> '
	
    ]) !!}

(in this case, only the first one will be displayed. )  
Also you can use array and empty that can cover all levels.

    {!! \FormStrap::alert(['danger', 'warning']) !!}
    {!! \FormStrap::alert() !!}
    
**Check if any alert exists**

    @if(\FormStrap::hasAlert())
        Alert exists!
    @endif
    
    or 
    
    @if(\FormStrap::hasAlert(['danger', 'info']))
        Alert exists!
    @endif

**CSS**  

    \FormStrap::css('input', 'your-class-name');  // for input-tag
    \FormStrap::css('label', 'your-class-name');  // for label-tag
    \FormStrap::css('group', 'your-class-name');  // for div-tag surrounding input and label 
    \FormStrap::css('content', 'your-class-name');  // for div-tag surrounding input
    
License
====
This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh