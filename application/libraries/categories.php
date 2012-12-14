<?php

class Categories {
	
	public function __construct(){}
	
	public static function buildCats($parent, $menu)
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			$html .= "<ul>";
			foreach ($menu['parents'][$parent] as $itemId)
			{
				if(!isset($menu['parents'][$itemId]))
				{
					$html .= "<li><a href='".base_url('catalogue/categories/'.$menu['items'][$itemId]['id'])."'>".$menu['items'][$itemId]['name']."</a></li> \n";
				}
				if(isset($menu['parents'][$itemId]))
				{
					$html .= "<li><a href='".base_url('catalogue/categories/'.$menu['items'][$itemId]['id'])."'>".$menu['items'][$itemId]['name']."</a> \n";
					$html .= self::buildCats($itemId, $menu);
					$html .= "</li> \n";
				}
			}
			$html .= "</ul> \n";
		}
		return $html;
	}
	
	public static function buildBreadCrumbs($menu, $key, $first, $sep='') 
	{
		$tmp = array();
 		foreach($menu['items'] as $v)
 		{
 			if($v['parent']>0){
			$tmp[$v['id']] = '<li><a href="'.base_url('catalogue/categories/'.$menu['items'][$v['parent']]['id']).'">'.$menu['items'][$v['parent']]['name'].'</a></li>'.$sep.'<li><a href="'.base_url('catalogue/categories/'.$v['id']).'">'.$v['name'].'</a></li>';
			continue;
 			} $tmp[$v['id']] = '<li><a href="'.base_url('catalogue/categories/'.$v['id']).'">'.$v['name'].'</a></li>';
		}
		
		$first_element = '<li><a href="'.base_url('catalogue').'">'.$first.'</a></li>';
		
		$result = isset($tmp[$key]) ? $first_element.$sep.$tmp[$key] : $first_element;
		
		return $result; 
	}
	
	
}
