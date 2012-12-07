<!-- <div id="overlay">
	<div class="jqmWindow">
    	<div class="jqmConfirmTitle">Добавить ...</div>
        <div class="badWords"></div>
        <div class="jqmClose"></div> 
 -->    <form class="addEditFrm" action="<?=base_url('admin/cats?act='.$action)?>" method="post">
        <input type="hidden" name="id" id="id" value="<?=isset($cat->id)?$cat->id:''?>" />
            <div>
            	<span class="formelement">Название Категории</span>
            	<input type="text" class="formfield" name="name" id="catName" value="<?=isset($cat->name)?$cat->name:''?>" autocomplete="off" placeholder="Название" />
            	<div class="error"></div>
            </div> 
	        <div>
            	<span class="formelement">Родительская Категория</span>
            	<select class="formfield" name="parent" id="catParent">
            		<option value="0">-------------</option>
            		<?php foreach ($categories as $cats):?>
	            		<option value="<?=$cats->id?>" <?php if($cats->id==@$cat->parent):?>selected<?php endif?>><?=$cats->name?></option>
            		<?php endforeach?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Отображение на сайте</span>
            	<select class="formfield" name="active" id="active">
            	<?php for($i=0;$i<=1;$i++):?>
            		<option value="<?=$i?>" <?php if($i==@$cat->active):?>selected<?php endif?>><?=$i?'Да':'Нет'?></option>
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