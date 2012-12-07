<h2 align="center">Авторы</h2>
<table width="100%" border="1">
	 <tr>
	  	<td class="tdhead">Название</td>
	  	<td class="tdhead">Отображение на сайте</td>
		<td class="tdhead" colspan="2">Редактирование \ Удаление</td>
	</tr>
	<?php foreach($authors as $val):?>
	<tr>
	    <td><?=$val->name?></td>
		<td><?=$val->active?'Да':'Нет'?></td>
	    <td class="edit"><a href="<?=base_url('admin/authors?act=edit&id='.$val->id)?>">&nbsp;</a></td>
	    <td class="remove"><a href="<?=base_url('admin/authors?act=remove&id='.$val->id)?>">&nbsp;</a></td>
	</tr>
	<?php endforeach?>
</table>
<div class="paginator"><?=@$paginator?></div>