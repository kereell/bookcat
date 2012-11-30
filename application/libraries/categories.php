<?php

class Categories {
	
	public function __construct(){}
	
	public static function build($parent, $menu)
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			$html .= "<ul>";
			foreach ($menu['parents'][$parent] as $itemId)
			{
				if(!isset($menu['parents'][$itemId]))
				{
					$html .= "<li><a href='".base_url('catalogue/books?cat='.$menu['items'][$itemId]['id'])."'>".$menu['items'][$itemId]['name']."</a></li> \n";
				}
				if(isset($menu['parents'][$itemId]))
				{
					$html .= "<li><a href='".base_url('catalogue/books?cat='.$menu['items'][$itemId]['id'])."'>".$menu['items'][$itemId]['name']."</a> \n";
					$html .= self::build($itemId, $menu);
					$html .= "</li> \n";
				}
			}
			$html .= "</ul> \n";
		}
		return $html;
	}
	
	
}

