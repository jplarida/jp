<?php

class Paging	{
	private $page_limit;
	private $url_obj;
	private $sql_obj;
	function __construct($page_limit,$sql_obj)	{
		$this->page_limit	=		$page_limit;
		$this->url_obj		=		new Url();
		$this->sql_obj		=		$sql_obj;
	}
	function getCurrentPage()	{
		$link			=	isset($_GET['p'])?$_GET['p']:'1';
		return $link;
	}
	
	function getTotalRecored($table,$where)	{
		return $this->sql_obj->RowCount($table,$where);
	}
	
	function currentList($show_numbers)	{
		return		($this->getCurrentPage() >= 4)?$this->getCurrentPage() - 3:1;
	}
	
	function showPaging($show_numbers,$table,$where)	{
		
		$total_records		=	$this->getTotalRecored($table,$where);
		if($total_records <= $this->page_limit)	{
			return;
		}
		$total_pages	=	ceil((int)$total_records / $this->page_limit);
		$current_url	=	$this->url_obj->remove_querystring_var($this->url_obj->curPageURL(),"p");
		
		$i 				= 	$this->currentList($show_numbers);
		
		//find the next number of pages
		$to				=	($this->getCurrentPage() == $total_pages || $this->getCurrentPage() == $total_pages - 1 || $this->getCurrentPage() == $total_pages - 2|| $this->getCurrentPage() == $total_pages - 3)?$this->getCurrentPage() + ($total_pages - $this->getCurrentPage()):$this->getCurrentPage() + 4;
		
		$pre			=	($this->getCurrentPage() <= 1) ? NULL:'<li><a href="'.$current_url.($this->getCurrentPage() - 1).'">< &nbsp;Previous</a></li>';
		$next			=	($this->getCurrentPage() >= $this->page_limit || $this->getCurrentPage() == $total_pages) ? NULL:'<a href="'.$current_url.($this->getCurrentPage() + 1).'"><li>Next&nbsp; ></a></li>';
		
		$paging			=	'<div id="Paging"><ul class="pagination pagination-centered">'.$pre;
		for($i;$i <= $to; $i++)	{
			$style		=	($i	==	$this->getCurrentPage())?'class="selected"':NULL;
			$paging		.=	'<li '.$style.'><a href="'.$current_url.$i.'">'.$i.'</a></li>';
		}
		return $paging.$next.'</ul></div>';
	}
	function getLimit()	{
		return 'LIMIT '.$this->page_limit*($this->getCurrentPage() - 1) .',' .$this->page_limit;
	}
	function getLimitAjax($page)	{
		$start_limit		=		(string)(((int)$page - 1)*(int)20);
		return 'LIMIT '.$start_limit.', 20';
	}
}
?>