<h2 align="center">Книги</h2>
<table width="100%" border="1" id="sort">
<thead>
	<tr class="topsort">
		<th class="tdhead noSort" width="20%">&nbsp;</th>
		<th class="tdhead" width="10%">Название</th>
		<th class="tdhead noSort" width="35%">Описание</th>
		<th class="tdhead" width="7%">Автор</th>
		<th class="tdhead" width="7%">Категория</th>
		<th class="tdhead" width="5%">Отображение на сайте</th>
		<th class="tdhead">Рейтинг</th>
		<th class="tdhead" width="5%">Дата Редактирования</th>
		<th class="tdhead noSort" width="8%" colspan="2">Редактирование \ Удаление</th>
	</tr>
	</thead>
	<tbody>
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
		<td class="rate" id="<?=$book->id?>">
			<div class="rateUp">+</div>
			<div class="rateSkill" id="rateSkill<?=$book->id?>"><?=$book->rate?></div>
			<div class="rateDown">-</div>
		</td>
		<td><?=$book->date?></td>
		<td class="edit"><a href='?act=edit&id=<?=$book->id?>'>&nbsp;</a></td>
		<td class="remove"><a href='?act=remove&id=<?=$book->id?>'>&nbsp;</a></td>
	</tr>
	<?php endforeach?>
	</tbody>
</table>
<div class="paginator"><?=@$paginator?></div>
	        	