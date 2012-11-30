$().ready(function(){
	$('div.ajaxLoad').show();
	$.get('http://localhost/bookcat/catalogue/books', function(res){
		$('.content').html(res);
		$('div.ajaxLoad').hide();
		});
	
		/** Links **/
	$('.nav a').live('click', function(){
		$('div.ajaxLoad').show();
		var url = $(this).attr('href');
		$.get(url, function(res){
			$('.content').html(res);
			$('div.ajaxLoad').hide();
			});
		return false;
	
	});
	
	
		/** Paginator **/
	$('.paginator a').live('click', function(){
		$('div.ajaxLoad').show();
		var url = $(this).attr('href');
		$.get(url, function(res){
			$('.content').html(res);
			$('div.ajaxLoad').hide();
				});
		return false;
	
	});
	
});