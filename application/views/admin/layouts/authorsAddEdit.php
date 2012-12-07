<!--<div id="overlay">
	<div class="jqmWindow">
    	<div class="jqmConfirmTitle">Добавить ...</div>
        <div class="badWords"></div>
        <div class="jqmClose"></div> 
 -->	<form class="addEditFrm" action="<?=base_url('admin/authors?act='.$action)?>" method="post">
        <input type="hidden" name="id" id="id" value="<?=isset($author->id)?$author->id:''?>" />
            <div>
            	<span class="formelement">Имя Автора</span>
            	<input type="text" class="formfield" name="name" id="authorName" value="<?=isset($author->name)?$author->name:''?>" autocomplete="off" placeholder="Название" />
            	<div class="error"></div>
            </div> 
            <div>
            	<span class="formelement">Отображение на сайте</span>
            	<select class="formfield" name="active" id="active">
            	<?php for($i=0;$i<=1;$i++):?>
            		<option value="<?=$i?>" <?php if($i==@$author->active):?>selected<?php endif?>><?=$i?'Да':'Нет'?></option>
   				<?php endfor?>
            	</select>
            	<div class="error"></div>
            </div>
            <div id="wrbtn">
            	<input type="submit" class="sBtns" name="sBtn" id="sBtn" name="sBtns" value="Add Record" onclick="">
            </div>
        </form>
<!--     </div>
</div>
 -->