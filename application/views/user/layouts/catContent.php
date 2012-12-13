	<ul id="breadcrumbs"><?=isset($crumbs)?$crumbs:''?></ul>
	<div id="wrapCats"><?php foreach($cont as $cat):?>
	<div id="alignCats"><div class="cats">
		<a href="<?=base_url('catalogue/index/'.$cat->id)?>"><?=$cat->name?></a>
	</div></div>
	<?php endforeach?></div>