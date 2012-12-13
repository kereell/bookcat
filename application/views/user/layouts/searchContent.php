<table width="100%" border="0" id="sort">
<thead>
	<tr class="topsort">
		<th class="noSort">Обложка&nbsp;</th>
		<th>Название книги&nbsp;</th>
		<th>Автор&nbsp;</th>
		<th width="280px" class="noSort">Описание&nbsp;</th>
		<th>Рейтинг</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($books as $crumbs => $books):?>
	<tr>
		<td colspan="5"><ul id="breadcrumbs"><?=$crumbs?></ul></td>
	</tr>
		<?php foreach ($books as $book):?>
		<tr>
			<?php if(file_exists('assets/img/upload/thumbnails/'.$book->img)):?>
				<td><?=img('assets/img/upload/thumbnails/'.$book->img)?></td>
			<?php else:?>
				<td><?=img('assets/img/default_thumb.jpg')?></td>
			<?php endif?>
			<td><?=$book->title?></td>
			<td><?=$book->author?></td>
			<td class="desc"><?=$book->description?></td>
			<td class="rate" id="<?=$book->id?>">
				<div class="rateUp">+</div>
				<div class="rateSkill" id="rateSkill<?=$book->id?>"><?=$book->rate?></div>
				<div class="rateDown">-</div>
		</td>
		</tr>
		<?php endforeach?>
	<?php endforeach?>
	</tbody>
</table>
<div class="paginator"><?=@$paginator?></div>