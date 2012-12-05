<div id="overlay">
	<div class="jqmWindow">
    	<div class="jqmConfirmTitle">Добавить ...</div>
        <div class="badWords"></div>
        <div class="jqmClose"></div> 
        <form class="addEditFrm" action="<?=base_url('admin/books?act=edit')?>" method="post">
            <div>
            	<span class="formelement">Название</span>
            	<input type="text" class="formfield" name="bookName" id="bookName" value="<?=$book->title?>" autocomplete="off" placeholder="Название" />
            	<div class="error"></div>
            </div> 
            <div>
            	<span class="formelement">Описание</span>
            	<input type="text" class="formfield" name="bookDescr" id="bookDescr" value="<?=$book->description?>" autocomplete="off" placeholder="Описание" />
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Рейтинг</span>
            	<select class="formfield" name="bookRate" id="bookRate">
            		<?php for($i=0;$i<=10;$i++):?>
            		<option value="<?=$i?>" <?php if($i==$book->rate):?>selected<?php endif?>><?=$i?></option>
            		<?php endfor?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Автор</span>
            	<select class="formfield" name="bookAuthor" id="bookAuthor">
            		<?php foreach ($authors as $author):?>
            		<option value="<?=$author->id?>" <?php if($author->name==$book->author_id):?>selected<?php endif?>><?=$author->name?></option>
            		<?php endforeach?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Категория</span>
            	<select class="formfield" name="bookCat" id="bookCat">
            		<?php foreach ($cats as $cat):?>
            		<option value="<?=$cat->id?>" <?php if($cat->id==$book->cat_id):?>selected<?php endif?>><?=$cat->name?></option>
            		<?php endforeach?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement">Отображение на сайте</span>
            	<select class="formfield" name="active" id="active">
            	<?php for($i=0;$i<=1;$i++):?>
            		<option value="<?=$i?>" <?php if($i==$book->active):?>selected<?php endif?>><?=$i?'Да':'Нет'?></option>
   				<?php endfor?>
            	</select>
            	<div class="error"></div>
            </div>
            <div>
            	<span class="formelement"></span>
            	<input type="text" class="formfield" id="" value="<?=$book->active?>" autocomplete="off" placeholder="......" />
            	<div class="error"></div>
            </div>
            <div id="wrbtn">
            	<input type="submit" class="sBtns" name="sBtn" id="sBtn" name="sBtns" value="Add Record" onclick="">
            </div>
        </form>
    </div>
</div>
