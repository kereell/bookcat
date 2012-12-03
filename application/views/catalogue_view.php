<?=doctype('html5')."\n"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')?>
		<?=link_tag('assets/css/user.css')?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="<?=base_url('assets/js/user.js')?>"></script>
	</head>
	<body>
		<div class="container">
			<div class="clearfloat"></div>
  			<div class="tophead">
  				<div id="sitename"><h1><a href="<?=base_url('catalogue')?>">Book Catalogue</a></h1></div>
  				<?php if(!isset($user['loggedIn'])):?>
 	 			<div id="logindiv">
  					<form action="<?=base_url('login')?>" method="post" >
	  					<label for="login">login</label>
	  					<input type="text" name="login" id="login" placeholder="login" /><br />
	  					<label for="password">password</label>
	  					<input type="password" name="passwd" id="password" placeholder="password" /><br />
	  					<input type="submit" name="lgnBtn" value="sign in" />
  					</form>
  				</div>
  				<?php else:?>
  				<div id="wellcome"><h1>Welcome <?=$user['name']?></h1></div>
  				<div id="sitename"><h1><a href="<?=base_url('admin')?>">Admin Area</a></h1></div>
  				<div id="logout"><h1><a href="<?=base_url('admin/logout')?>">Logout</a></h1></div>
  				<?php endif?>
  			</div>
  			<div id="searchdiv"> 
  				<form action="<?=base_url('catalogue')?>" method="get" >
					<table width="100%" border="0">
						<tr>
						    <td width="9%" align="right" class="searchtable"><label for="search" >поиск</label>&nbsp;</td>
						    <td width="83%"><input type="text" name="search" id="search" value="<?=isset($_GET['q'])?$_GET['q']:''?>" /></td>
						    <td width="8%" align="left" class="searchtable"><input name="" type="submit" value="Найти" />&nbsp;</td>
					  	</tr>
					</table>
				</form>
   			</div>
			<div class="sidebar1">
				<div id="nav" class="nav">
					<?=$categories?>
				</div>
			    <p>&nbsp;</p>
			    <p>Sidebar</p>
			  	<!-- end .sidebar1 -->
		  	</div>
		  	<div class="ajaxLoad">&nbsp;</div>
		  	<div class="breadcrumbs"><?=$breadcrumbs?></div>
			<div class="content">
			<?=$cont?>
			</div>
		</div>	
		<div style="background-color: grey;" id="footer">Footer</div>
	</body>
</html>