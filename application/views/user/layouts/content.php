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
		<?php if(file_exists('assets/img/upload/thumbnails/'.$book->img)):?>
			<td><?=img('assets/img/upload/thumbnails/'.$book->img)?></td>
		<?php else:?>
			<td><?=img('assets/img/default_thumb.jpg')?></td>
		<?php endif?>
		<td><?=$book->title?></td>
		<td><?=$book->author?></td>
		<td class="desc"><?=$book->description?></td>
		<td>Художественная литература => Золотой Век</td>
	</tr>
	<?php endforeach?>
</table>
<div class="paginator"><?=@$paginator?></div>