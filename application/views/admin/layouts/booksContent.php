<h2 align="center">Книги</h2>
<table width="100%" border="1">
	<tr>
		<td class="tdhead" width="20%">&nbsp;</td>
		<td class="tdhead" width="10%">Название</td>
		<td class="tdhead" width="35%">Описание</td>
		<td class="tdhead" width="7%">Автор</td>
		<td class="tdhead" width="7%">Категория</td>
		<td class="tdhead" width="5%">Отображение на сайте</td>
		<td class="tdhead" width="5%">Дата Редактирования</td>
		<td class="tdhead"width="8%" colspan="2">Редактирование \ Удаление</td>
	</tr>
	<?php foreach($books as $val):?>
	<tr>
		<td><?=img('assets/img/'.$val->img.'.jpg')?></td>
		<td><?=$val->title?></td>
		<td><?=$val->description?></td>
		<td><?=$val->author?></td>
		<td><?=$val->category?></td>
		<td><?=$val->active?'Да':'Нет'?></td>
		<td><?=$val->date?></td>
		<td class="edit"><a href='<?=base_url('admin/books?act=edit&id='.$val->id)?>'>&nbsp;</a></td>
		<td class="remove"><a href='<?=base_url('admin/books?act=remove&id='.$val->id)?>'>&nbsp;</a></td>
	</tr>
	<?php endforeach?>
</table>
<div class="paginator"><?=@$paginator?></div>
	        	