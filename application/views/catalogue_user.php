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
  				<div id="sitename"><h1>Welcome <?=$user['name']?></h1></div>
  				<div id="sitename"><h1><a href="<?=base_url('admin')?>">Admin Area</a></h1></div>
  				<div id="sitename"><h1><a href="<?=base_url('admin/logout')?>">Logout</a></h1></div>
  				<?php endif?>
  			</div>
  			<div id="searchdiv"> 
  				<form action="<?=base_url('catalogue/search')?>" method="get" >
					<table width="100%" border="0">
						<tr>
						    <td width="9%" align="right" class="searchtable"><label for="search" >поиск</label>&nbsp;</td>
						    <td width="83%"><input type="text" name="q" id="search" value="<?=isset($_GET['q'])?$_GET['q']:''?>" /></td>
						    <td width="8%" align="left" class="searchtable"><input name="" type="submit" value="Найти" />&nbsp;</td>
					  	</tr>
					</table>
				</form>
   			</div>
			<div class="sidebar1">
				<div id="nav">
					<ul>
						<?php foreach($cats as $cat):?>
			    		<li><a href="<?=base_url('catalogue?cat='.$cat->id)?>"><?=$cat->name?></a>
			    		<ul><li><a>hjkhlkhjlkjhkl</a></li></ul></li>
			    		<?php endforeach?>    
					</ul>
				</div>
			    <p>&nbsp;</p>
			    <p>Это сайдбар. Здесь можно что-то написать</p>
			  	<!-- end .sidebar1 -->
		  	</div>
			<div class="content">
		    	<table width="100%" border="0" id="sort">
					<tr class="topsort">
						<td>Обложка&nbsp;</td>
						<td>Название книги&nbsp;</td>
						<td>Автор&nbsp;</td>
						<td width="280px">Описание&nbsp;</td>
						<td>Рейтинг</td>
					</tr>
					<?php foreach($books as $book):?>
					<tr>
						<td><?=img('assets/img/'.$book->img.'.jpg')?></td>
					  	<td><?=$book->title?></td>
					  	<td><?=$book->author?></td>
						<td><?=$book->description?></td>
						<td><?=$book->rate?></td>
					</tr>
					<?php endforeach?>
				</table>	
				<!-- end .content -->
			</div>
		</div>	
		<div id="footer">А это футер. Здесь тоже можно что-то написать.</div>
	</body>
</html>