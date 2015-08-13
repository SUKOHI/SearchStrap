<?php namespace Sukohi\SearchStrap;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
class SearchStrap {

	private $_placeholder = 'Search..';
	private $_button_label = 'Search';
	private $_default_filter_key = '';
	private $_filters, $_dropdown_data = [];
	private $_color_types = ['filter' => 'info', 'button' => 'primary'];
	
    public function __toString() {
    	
    	$keyword = '';
    	
    	foreach ($this->_filters as $key => $filter) {
    		
    		if(Input::has($key)) {
    			
    			$keyword = Input::get($key);
    			break;
    			
    		}
    		
    	}
    	
    	return View::make('packages.sukohi.search-strap.main', [
    		'filters' => $this->_filters,
    		'dropdown_data' => $this->_dropdown_data, 
    		'button_label' => $this->_button_label, 
    		'color_types' => $this->_color_types, 
    		'placeholder' => $this->_placeholder, 
    		'default_filter_key' => $this->_default_filter_key, 
    		'keyword' => $keyword
    	])->render();
    	
    }
    
    public function filters($values, $default_key = '', $color_type = 'info') {
    	
    	$this->_filters = $values;
    	$this->_color_types['filter'] = $color_type;
    	$this->_default_filter_key = (empty($default_key)) ? key($values) : $default_key;
    	return $this;
    	
    }
    
    public function dropdown($type_key, $values) {
    	 
    	$this->_dropdown_data[$type_key] = $values;
    	return $this;
    	 
    }
    
    public function button($label, $color_type = 'primary') {
    	
    	$this->_button_label = $label;
    	$this->_color_types['button'] = $color_type;
    	return $this;
    	
    }
    
    public function placeholder($placeholder) {
    	
    	$this->_placeholder = $placeholder;
    	return $this;
    	
    }
    
    public static function js($focus_flag = true) {
    	
    	return View::make('packages.sukohi.search-strap.js', ['focus_flag' => $focus_flag])->render();
    	
    }
    
    public static function modelFilter($model, $columns, $replacements = [], $prefix = 'filter') {
    	
    	$model->search_key = '';
    	
    	foreach ($columns as $column) {
    		
    		$scope_method = camel_case($prefix .'_'. $column);
    		
    		if(Input::has($column)) {
    		
    			$model->search_key = $column;
    			
	    		if(isset($replacements[$column])) {
	    			
	    			$column = $replacements[$column];
	    			
	    		}
    				
    			$model = $model->$scope_method(Input::get($column));
    			break;
    				
    		}
    		
    	}
    	
    	return $model;
    	
    }

}