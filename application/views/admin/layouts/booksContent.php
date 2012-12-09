<h2 align="center">Книги</h2>
<table width="100%" border="1">
	<tr>
		<td class="tdhead" width="20%">&nbsp;</td>
		<td class="tdhead" width="10%">Название</td>
		<td class="tdhead" width="35%">Описание</td>
		<td class="tdhead" width="7%">Автор</td>
		<td class="tdhead" width="7%">Категория</td>
		<td class="tdhead" width="5%">Отображение на сайте</td>
		<td class="tdhead">Рейтинг</td>
		<td class="tdhead" width="5%">Дата Редактирования</td>
		<td class="tdhead" width="8%" colspan="2">Редактирование \ Удаление</td>
	</tr>
	<?php foreach($books as $book):?>
	<tr>
		<?php if(file_exists('assets/img/upload/thumbnails/'.$book->img)):?>
			<td><?=img('assets/img/upload/thumbnails/'.$book->img)?></td>
		<?php else:?>
			<td><?=img('assets/img/default_thumb.jpg')?></td>
		<?php endif?>
		<td><?=$book->title?></td>
		<td><?=$book->description?></td>
		<td><?=$book->author?></td>
		<td><?=$book->category?></td>
		<td><?=$book->active?'Да':'Нет'?></td>
		<td><?=$book->rate?></td>
		<td><?=$book->date?></td>
		<td class="edit"><a href='?act=edit&id=<?=$book->id?>'>&nbsp;</a></td>
		<td class="remove"><a href='?act=remove&id=<?=$book->id?>'>&nbsp;</a></td>
	</tr>
	<?php endforeach?>
</table>
<div class="paginator"><?=@$paginator?></div>
	        	