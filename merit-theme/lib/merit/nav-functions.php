<?php

use Roots\Sage\Nav\NavWalker;
use Roots\Sage\Titles;


function format_menu($menu){
	$acfields = get_fields( $menu->ID );
	$html = '';
	$main_links = $acfields['main_links'];
	if(!empty($main_links)){ 
		$link_count = count($main_links);
		if($link_count == '3'){ 
			$class = 'col-sm-4';
		}elseif($$link_count == '4'){ 
			$class = 'col-sm-3';
		}
		$html .= '<div class="tabs clearfix">'."\n";
			foreach($main_links as $k=>$v){
				$color = $v['color'];
				$html .= '<div class="category '.$class.'"><div class="tab '.$color.'"><a href="'.$v['link'].'">'.$v['title'].'</a></div>'."\n";
				$html .= '</div>';
			}
		$html .= '</div>'."\n";
	}
	$columns = $acfields['columns'];
	if(!empty($columns)){
		$html .= '<div class="columns clearfix">'."\n";
		foreach($columns as $k=>$v){
			if($v['column_width'] == 'double'){
				$class = 'col-sm-8 double';
			}else{
				$class = 'col-sm-4';
			}
			$html .= '<div class="column '.$class.'">'."\n";
			$html .= '<h2>'.$v['title'].' <span class="toggle"></span></h2>'."\n";
			$html .= '<ul>'."\n";
			foreach($v['links'] as $v=>$link){
				$html .= '<li><a href="'.get_permalink($link).'">'.get_the_title($link).'</a></li>'."\n";
			}
			$html .= '</ul>'."\n";
			$html .= '</div>'."\n";
		}
		$html .= '</div>'."\n";
	}
	$footer_links = $acfields['footer_links'];
	if(!empty($footer_links)){
		$html .= '<ul class="footer_links clearfix">'."\n";
		foreach($footer_links as $k=>$v){
			$html .= '<li><a href="'.get_permalink($v).'"><span>'.get_the_title($v).'</span></a></li>'."\n";
		}
		$html .= '<li class="mobile donate"><a href="/support-merit"><i class="fa fa-money"></i> Donate</a></li>';
		$html .= '<li class="mobile search"><a href="/search"><i class="fa fa-search"></i> Search</a></li>';
		$html .= '<li class="mobile account"><a href="https://apm.activecommunities.com/meritmusic/ActiveNet_Login"><i class="fa fa-gear"></i> My Account</a></li>';
		$html .= '</ul>'."\n";
	}
	echo $html;
}
?>