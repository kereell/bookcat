<?=doctype('html5')."\n"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')?>
		<?=link_tag('assets/css/style.css')?>
	</head>
	<body>
		<div class="container">
			<div class="clearfloat"></div>
  			<div class="tophead">
  				<div id="sitename"><h1><a href="<?=base_url('catalogue')?>">Book's Catalogue</a></h1></div>
  				<div id="sitename"><h1>Welcome <?=$user['name']?></h1></div>
  				<div id="sitename"><h1><a href="<?=base_url('admin/logout')?>">Logout</a></h1></div>
  			</div>
			<div class="sidebar1">
			    <p>&nbsp;</p>
			    <p>Это сайдбар. Здесь можно что-то написать</p>
			  	<!-- end .sidebar1 -->
		  	</div>
			<div class="content">	
				<!-- end .content -->
			</div>
		</div>	
		<div id="footer">А это футер. Здесь тоже можно что-то написать.</div>
	</body>
</html>