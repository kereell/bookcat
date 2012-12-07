<!-- <div id="overlay">
	<div class="jqmWindow">
    	<div class="jqmConfirmTitle">Добавить ...</div>
        <div class="badWords"></div>
        <div class="jqmClose"></div> 
 -->        <form class="addEditFrm" action="<?=base_url('admin/books?act='.$action)?>" method="post">
        <input type="hidden" name="id" id="id" value="<?=isset($book->id)?$book->id:''?>" />
            <div>
            	<span class="formelement">Название</span>
            	<input type="text" class="formfield" name="title" id="bookTitle" value="<?=isset($book->title)?$book->title:''?>" autocomplete="off" placeholder="Название" />
            	<div class="error"></div>
            </div> 
            <div>
            	<span class="formelement">Описание</span>
            	<input type="text" class="formfield" name="description" id="bookDescription" value="<?=isset($book->description)?$book->description:''?>" autocomplete="off" placeholder="Описание" />
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Рейтинг</span>
            	<select class="formfield" name="rate" id="bookRate">
            		<?php for($i=0;$i<=10;$i++):?>
            		<option value="<?=$i?>" <?php if($i==@$book->rate):?>selected<?php endif?>><?=$i?></option>
            		<?php endfor?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Автор</span>
            	<select class="formfield" name="id_author" id="bookAuthor">
            		<option>-------------</option>
            		<?php foreach ($authors as $author):?>
            		<option value="<?=$author->id?>" <?php if($author->id==@$book->author_id):?>selected<?php endif?>><?=$author->name?></option>
            		<?php endforeach?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Категория</span>
            	<select class="formfield" name="id_category" id="bookCat">
            		<option>-------------</option>
            		<?php foreach ($cats as $cat):?>
            		<option value="<?=$cat->id?>" <?php if($cat->id==@$book->cat_id):?>selected<?php endif?>><?=$cat->name?></option>
            		<?php endforeach?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Отображение на сайте</span>
            	<select class="formfield" name="active" id="active">
            	<?php for($i=0;$i<=1;$i++):?>
            		<option value="<?=$i?>" <?php if($i==@$book->active):?>selected<?php endif?>><?=$i?'Да':'Нет'?></option>
   				<?php endfor?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement"></span>
            	<input type="text" class="formfield" name="img" id="img" value="" autocomplete="off" placeholder="" />
            	<div class="error"></div>
            </div>
            <div id="wrbtn">
            	<input type="submit" class="sBtns" name="sBtn" id="sBtn" name="sBtns" value="Add Record" onclick="">
            </div>
        </form>
<!--     </div>
</div>
 -->