SearchStrap
===========

A PHP package mainly developed for Laravel to manage a search box that we can easily use.  
(This is for Laravel 4.2. [For Laravel 5](https://github.com/SUKOHI/SearchStrap))

![Example-1](http://i.imgur.com/cQCPpvH.png)  
  
![Example-2](http://i.imgur.com/glRyfJk.png)

Installation
====

Add this package name in composer.json

    "require": {
      "sukohi/search-strap": "1.*"
    }

Execute composer command.

    composer update

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        'Sukohi\SearchStrap\SearchStrapServiceProvider',
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'SearchStrap' => 'Sukohi\SearchStrap\Facades\SearchStrap',
    ]

Requirements
====

* [jQuery](https://jquery.com/)
* [Bootstrap](http://getbootstrap.com/)
* [Font-Awesome](http://fortawesome.github.io/Font-Awesome/)

Usage
====

**Preparation for JavaScript**

    <script type="text/javascript">
    
		$(document).ready(function(){
		
			{{ SearchStrap::js($focus_flag = true) }}
			
		});
    
    </script>

* If `$focus_flag` is true, the input box will be focused on when opening the page.


**Minimal Way**

    {{ SearchStrap::filters([
		'key_1' => 'Label 1', 
		'key_2' => 'Label 2', 
		'key_3' => 'Label 3'
	]) }}
    
**with Dropdown**
    
    {{ SearchStrap::filters([
		'key_1' => 'Label 1', 
		'key_2' => 'Label 2', 
		'key_3' => 'Label 3'
	])
	->dropdown('key_3', [
		'us' => 'USA',
		'ca' => 'Canada',
		'gb' => 'United Kingdom', 
		'de' => 'Germany', 
		'ja' => 'Japan'
	]) }}

* You can use dropdown() multiply as you need.

**with Options**

    {{ SearchStrap::filters(
			[
				'key_1' => 'Label 1', 
				'key_2' => 'Label 2', 
				'key_3' => 'Label 3'
			], 
			'key_2',     // Default key
			$color_type = 'info'    // color type of Bootstrap
		)
		->button('Button Label', $color_type = 'primary')   // Optional
		->placeholder('Placeholder text')   // Optional 
	}}

* $color_type can be `default`, `primary`, `success`, `info`, `warning` and `danger`.
* See [here](http://getbootstrap.com/examples/theme/).

**Model Filter**  

This method provides adding filters(where clause) to Eloquent model object.  
At first, you need to add accessors related to `key` into a specific model you want.

    class Item extends Eloquent {
    	
    	// Scopes 
    	
    	public function scopeFilterId($query, $id) {
    	
    		return $query->where('id', $id);
    		
    	}
    	
    	public function scopeFilterTitle($query, $title) {
    	
    		return $query->where('title', 'LIKE', '%'. $title .'%');
    		
    	}
    	
    	public function scopeFilterDate($query, $dt) {
    	
    		return $query->where('created_at', '>', $dt);
    		
    	}
    	
    }

So, if you'd like to search data by key called `title`, you need to add method(accessor) called `scopeFilterTitle` like above.  
And now you can generate search box in your controller.

	$items = Item::select();
	$items = SearchStrap::modelFilter(
		$items, 
		$columns = ['id', 'title', 'created_at'], 
		$replacements = ['created_at' => 'date'], 
		$prefix = 'filter'
	);
	$items->get();	// Here, data is filtered if search key and value exist.
	
	echo $items->search_key;
		
* $items
	* Model object you'd like to search.
	* Note: Don't call `get()`, `first()` yet.
* $columns
	* Columns to search.
	* It means unless you add column(s) here data will not be filtered.
* $replacements
	* Replacements values.
	* In this case, if search key is "created_at", scopeFilterDate() will be called.
* $prefix
	* This is Prefix for accessor(s).
	* For example, if you set 'search' here, `scopeSearch***` will be called.

* search_key
	* Current search key.

License
====
This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh