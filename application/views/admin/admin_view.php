<?=doctype('html5')."\n"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')."\n"?>
		<?=link_tag('assets/css/admin.css')."\n"?>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
		<script src="<?=base_url('assets/js/admin.js')."\n"?>"></script>
		<title><?=@$title.@$addTitle?></title>    
	</head>
	<body>
		<div class="container">
			<div class="clearfloat"></div>
  			<div class="tophead">
  				<div id="sitename"><h1><a href="<?=base_url('catalogue')?>">User side</a></h1></div>
  				<div id="welcome"><h1>Welcome <?=$user['name']?></h1></div>
  				<div id="logout"><h1><a href="<?=base_url('admin/logout')?>">Logout</a></h1></div>
                <div id="menu">
		       		<ul id="ulmenu">
		        		<li><a href="<?=base_url('admin/cats')?>">Категории </a></li>
	        	   		<li><a href="<?=base_url('admin/books')?>">Книги </a></li>
	        			<li><a href="<?=base_url('admin/authors')?>">Авторы</a> </li>
		       		</ul>
        		</div>
            </div><!--end of tophead -->
            <div class="content">
    			<div class="buttons">
    				<button style="display: none;" class="onebutton" role="button" onClick="openAdd()">Добавить</button>
    				<a href="<?=base_url('admin/'.$method.'?act=add')?>">Добавить</a>
    			</div>
	    		<div id="intcontent">
		    	<?=$content?>
				</div><!-- end .content -->
			</div><!--end container -->
			<div id="footer">Футер.</div>
		</div>
	</body>
</html>