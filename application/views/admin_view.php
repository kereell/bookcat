<?=doctype('html5')."\n"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv')."\n"?>
		<?=link_tag('assets/css/admin.css')."\n"?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="<?=base_url('assets/js/admin.js')."\n"?>"></script>
        
	</head>
	<body>
		<div class="container">
			<div class="clearfloat"></div>
  				<div class="tophead">
  			  		<div id="sitename"><h1><a href="<?=base_url('catalogue')?>">Book's Catalogue</a></h1></div>
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
			<!-- <div class="sidebar1">
				 
			</div> --><!-- end .sidebar1 -->
			<div class="content">
    			<div class="buttons">
    				<button class="onebutton" role="button" onClick="openAdd()">Добавить</button>
    			</div>
	    		<div id="intcontent">
	    			<?php if(isset($authors)):?>
	        		<h2 align="center">Авторы</h2>
	    			<table width="100%" border="1">
		  				<tr>
		  					<td class="tdhead">Название</td>
		  					<td class="tdhead">Отображение на сайте</td>
		  					<td class="tdhead">Примечание</td>
		  					<td class="tdhead" colspan="2">Редактирование \ Удаление</td>
		  				</tr>
						<?php foreach($authors as $val):?>
						<tr>
						    <td><?=$val->name?></td>
							<td><?=$val->active?'Да':'Нет'?></td>
							<td><?=$val->note?></td>
						    <td class="edit"><a href="<?=base_url('admin/authors?act=edit&id='.$val->id)?>">&nbsp;</a></td>
						    <td class="remove"><a href="<?=base_url('admin/authors?act=remove&id='.$val->id)?>">&nbsp;</a></td>
						</tr>
						<?php endforeach?>
					</table>
	        	</div>
					<?php elseif(isset($cats)):?>
					<h2 align="center">Категории</h2>
	    			<table width="100%" border="1">
	    				<tr>
	    					<td class="tdhead">Название</td>
	    					<td class="tdhead">Родитель</td>
	    					<td class="tdhead">Отображение на сайте</td>
	    					<td class="tdhead" colspan="2">Редактирование \ Удаление</td>
	    				</tr>
						<?php foreach($cats as $val):?>
						<tr>
							<td><?=$val->name?></td>
							<td><?=$val->parent?></td>
							<td><?=$val->active?'Да':'Нет'?></td>
							<td class="edit"><a href='<?=base_url('admin/cats?act=edit&id='.$val->id)?>'>&nbsp;</a></td>
							<td class="remove"><a href='<?=base_url('admin/cats?act=remove&id='.$val->id)?>'>&nbsp;</a></td>
						</tr>
						<?php endforeach?>
					</table>
	        	</div>
					<?php elseif(isset($books)):?>
					<h2 align="center">Книги</h2>
	    			<table width="100%" border="1">
						<tr>
						    <td class="tdhead">&nbsp;</td>
						    <td class="tdhead">Название</td>
						    <td class="tdhead">Описание</td>
						    <td class="tdhead">Автор</td>
						    <td class="tdhead">Категория</td>
						    <td class="tdhead">Отображение на сайте</td>
						    <td class="tdhead">Дата Редактирования</td>
							<td class="tdhead" colspan="2">Редактирование \ Удаление</td>
						</tr>
						<?php foreach($books as $val):?>
						<tr>
							<td><?=$val->img?></td>
							<td><?=$val->title?></td>
							<td><?=$val->description?></td>
							<td><?=$val->id_author?></td>
							<td><?=$val->id_category?></td>
							<td><?=$val->active?'Да':'Нет'?></td>
							<td><?=$val->date?></td>
							<td class="edit"><a href='<?=base_url('admin/books?act=edit&id='.$val->id)?>'>&nbsp;</a></td>
							<td class="remove"><a href='<?=base_url('admin/books?act=remove&id='.$val->id)?>'>&nbsp;</a></td>
						</tr>
						<?php endforeach?>
					</table>
	        	</div>
	        	<div class="paginator"><?=$paginator?></div>
					<?php endif?>
			</div><!-- end .content -->
		</div><!--end container -->
		<div id="footer">Футер.</div>
	</body>
</html>