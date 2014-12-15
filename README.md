SearchStrap
===========

A PHP package mainly developed for Laravel to manage a search box that we can easily use.

(Examples)  
![Example-1](http://i.imgur.com/cQCPpvH.png)
![Example-2](http://i.imgur.com/glRyfJk.png)

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
    
    	{{ SearchStrap::js($focus_flag = true) }}
    	
    });
    </script>

* If $focus_flag is true, the input box will be focused on when page loading.


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

**Model Filter**  
This method provides adding filters(where clause) to Eloquent model object.

At first, you need to add accessors to a specific model you want.

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

and then use like this in your Controller.

		$items = Item::select();
		$items = SearchStrap::modelFilter(
				$items, 
				['id', 'title', 'created_at'], 
				['created_at' => 'date'], 
				'filter'
		);
		echo $items->search_key;
		
* 1st argument is model object(Don't call get(), first() and on yet).
* 2nd argument is columns to search automatically (Need to match search key which means $_GET['\*\*\*']).
* 3rd argument is replacements values. In this case, if search key is "created_at", scopeFilterDate() will be called.
* 4th argument is prefix. For example if you set 'search' here, scopeSearch\*\*\* will be called.

License
====
This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh