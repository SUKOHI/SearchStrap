FormStrap
====

A PHP package mainly developed for Laravel to generate form input tags of Bootstrap that can display errors.

Installation&setting for Laravel
====

After installation using composer, add the followings to the array in  app/config/app.php

    'providers' => array(  
        ...Others...,  
        'Sukohi\FormStrap\FormStrapServiceProvider'  
    )

Also

    'aliases' => array(  
        ...Others...,  
        'Sukohi\FormStrap\Facades\FormStrap'
    )
And then  execute to publish the view

    php artisan view:publish sukohi/form-strap

Usage(with blade)
====  
**Text**  

    {{ FormStrap::text('name_1', 'text') }}
    
    
**Label**

    {{ FormStrap::text('name_2', 'text')->label('LABEL') }}
				
    {{ FormStrap::text('name_3', 'text')->label('LABEL', ['class' => 'text-danger']) }}
				
    {{ FormStrap::text('name_4', 'text')->label('<i class="fa fa-home"></i> LABEL')->raw() }}
    
**Password**

    {{ FormStrap::password('name_9', $options = []) }}
    
**Textarea**

    {{ FormStrap::textarea('name_10', 'Text', $options = []) }}
    
**Radio Button(s)**

    {{ FormStrap::radio('name_11', ['value' => 'label'], 'checked_value', $options = []) }}
			
    {{ FormStrap::radio('name_12', [
    		'value_1' => 'label_1', 
    		'value_2' => 'label_2', 
    		'value_3' => 'label_3'
    	], 'checked_value', $options = [], $separator = '&nbsp;') }}
				
**Checkbox(es)**

    {{ FormStrap::checkbox('name_13', ['value' => 'label'], ['checked_value'], $options = []) }}
				
    {{ FormStrap::checkbox('name_14', [
		'value_1' => 'label_1', 
		'value_2' => 'label_2', 
		'value_3' => 'label_3'
	], [
		'checked_value_1', 
		'checked_value_2'
	], $options = [], $separator = '&nbsp;') }}
	
**Select**

    {{ FormStrap::select('name_15', [
		'' => '', 
		'value_1' => 'label_1', 
		'value_2' => 'label_2', 
		'value_3' => 'label_3'
	], 'selected_value', $options = []) }}
	
**File**

    {{ FormStrap::file('name_16', $options = []) }}
	
    {{ FormStrap::file('name_17')->multiple() }}
	
    {{ FormStrap::file('name_18')->accept('image/*') }}
	
**Hidden(s)**

	{{ FormStrap::hidden([
		'name_19' => 'value_1', 
		'name_20' => 'value_2', 
		'name_21' => 'value_3'
	]) }}
	
**Custom view**

    {{ FormStrap::view('name_22', 'custom.view', $parameters = []) }}
    
**Submit**

    {{ FormStrap::submit('Submit <i class="fa fa-home"></i>', ['class' => 'btn btn-success btn-sm']) }}
    
    {{ FormStrap::submit('Submit', ['class' => 'btn btn-success btn-sm'])
			->cancel('url', 'CANCEL', ['class' => 'btn btn-default btn-sm']) }}
	
    {{ FormStrap::submit('Submit')->cancel('url')->right() }}