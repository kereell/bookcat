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
				<div id="nav">
					<ul>
						<li><a href="<?=base_url('/manage_cats')?>">Категории</a>
							<ul>
								<li><a href="<?=base_url('/manage_cats/add')?>">Добавить</a></li>
								<li><a href="<?=base_url('/manage_cats/remove')?>">Удалить</a></li>
							</ul>
						</li>
						<li><a href="<?=base_url('/manage_authors')?>">Авторы</a>
						<ul>
								<li><a href="<?=base_url('/manage_authors/add')?>">Добавить</a></li>
								<li><a href="<?=base_url('/manage_authors/remove')?>">Удалить</a></li>
							</ul>
						</li>
						<li><a href="<?=base_url('/manage_books')?>">Книги</a>
						<ul>
								<li><a href="<?=base_url('/manage_books/add')?>">Добавить</a></li>
								<li><a href="<?=base_url('/manage_books/remove')?>">Удалить</a></li>
							</ul>
						</li>
					</ul>
				</div>
			    <p>&nbsp;</p>
			    <p>Sidebar</p>
			  	<!-- end .sidebar1 -->
		  	</div>
			<div class="content">	
				<table>
				<?php foreach($books as $val):?>
					<tr>
						<td><?=$val->img?></td>
						<td><?=$val->title?></td>
						<td><?=$val->description?></td>
						<td><?=$val->id_author?></td>
						<td><?=$val->id_category?></td>
						<td><?=$val->active?></td>
						<td><?=$val->date?></td>
					</tr>
					<?php endforeach?>
				</table>
			</div>
		</div>	
		<div id="footer">Footer</div>
	</body>
</html>