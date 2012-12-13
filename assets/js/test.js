window.addEvent('domready', function() {
	var tbl = new HtmlTable('sort',{
		classNoSort:'noSort'
	});
	tbl.enableSort();
	$$('th').addEvent('click', function(){
		tbl.sort(0,true,true);
	});
	
	
});