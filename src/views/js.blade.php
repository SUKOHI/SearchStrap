$('#search-strap-form .dropdown-menu').find('a').bind('click', function(e) {
	 
	e.preventDefault();
	var param = $(this).attr('href').replace('#','');
	var filterTitle = $(this).text();
	$('#search-strap-form span#search_title').text(filterTitle);
	$('#search-strap-form #search_param').val(param);

	var selectboxKeysStr = $('#search_param').data('dropdowns');

	if(selectboxKeysStr != '') {

		var selectboxKeys = selectboxKeysStr.split(',');

		$.each(selectboxKeys, function(index, key){

			if(key == param) {

				$('#search_key_'+ key).show();

			} else {

				$('#search_key_'+ key).hide();

			}

		});
		
		if($('#search_key_'+ param).length) {
			
			$('#search_key').hide();

		} else {
		
			$('#search_key').show();

		}

	}
	
});
$('#search-strap-form').on('submit', function(){

	var param = $('#search-strap-form #search_param').val();
	var value = '';
	
	if($('#search-strap-form #search_key_'+ param).length) {
	
		value = $('#search-strap-form #search_key_'+ param).val();
	
	} else {
	
		value = $('#search-strap-form #search_key').val();
	
	}
	
	location.href = '{{ Request::url() }}?'+ param +'='+ value;
	return false;

});