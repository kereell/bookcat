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
<div class="paginator"><?=@$paginator?></div>