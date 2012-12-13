window.addEvent('domready', function() {
		/** Sort **/
	var tbl = new HtmlTable('sort',{
		classNoSort:'noSort'
	});
	tbl.enableSort();
	$$('th').addEvent('click', function(){
		tbl.sort(0,true,true);
	});
		/** Rate Ajax **/
	$$('.rateUp, .rateDown').addEvent('click', function(e){
        e = new Event(e); e.preventDefault();
        var item = this.getParent().getProperty('id');
        var action = this.getProperty('class');
        var req = new Request.JSON({
        	method: 'post',
        	data: 'act='+action+'&id='+item,
            url: '/bookcat/catalogue/rate',
            onSuccess: function(res) { 
               $('rateSkill'+res.id).set('html', res.rate);
             },  
             onFailure: function(t) { 
                  alert('К сожалению, сервер упал и ничего не работает :('+t); 
            }
        });
        req.send();
    });
	
});
