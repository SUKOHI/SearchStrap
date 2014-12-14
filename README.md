SearchStrap
===========

A PHP package mainly developed for Laravel to manage a search box that we can easily use.

Installation&settings for Laravel
====

After installation using composer, add the followings to the array in  app/config/app.php

    'providers' => array(  
        ...Others...,  
        'Sukohi\SearchStrap\SearchStrapServiceProvider',
    )

Also

    'aliases' => array(  
        ...Others...,  
        'SearchStrap' =>'Sukohi\SearchStrap\Facades\SearchStrap',
    )
And then  execute the next command to publish the view

    php artisan view:publish sukohi/search-strap

Requirements
====  

jQuery, Bootstrap and Font-Awesome

Usage
====  

**Preparation for JavaScript**

    <script type="text/javascript">
    $(document).ready(function(){
    
    	{{ SearchStrap::js() }}
    	
    });
    </script>

**Minimal Way**

    {{ SearchStrap::filters([
    		'id' => 'ID', 
    		'name' => 'Name', 
    		'country_code' => 'Country'
    	]) }}
    
This means 'key' => 'Label'.

**with Dropdown**
    
    {{ SearchStrap::filters([
		'id' => 'ID', 
		'name' => 'Name', 
		'country_code' => 'Country'
	])
	->dropdown('country_code', [
		'us' => 'USA',
		'ca' => 'Canada',
		'gb' => 'United Kingdom', 
		'de' => 'Germany', 
		'ja' => 'Japan'
	]) }}

*You can use dropdown() multiply as you need.

**with Options**

    {{ SearchStrap::filters(
    		[
    			'id' => 'ID', 
    			'name' => 'Name', 
    			'country_code' => 'Country'
    		], 
    		'name',     // Default filter key
    		$color_type = 'info'    // color type of Bootstrap
    	)
    	->button('Button Label', $color_type = 'primary')   // Skippable
    	->placeholder('Placeholder text')   // Skippable }}

License
====
This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh