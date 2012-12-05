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
<div class="paginator"><?=@$paginator?></div>
