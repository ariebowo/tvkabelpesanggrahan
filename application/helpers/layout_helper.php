<?php 

if ( ! function_exists('buildBreadcrumb'))
{
	function buildBreadcrumb($url = '', $breadcrumb = array())
	{
		$list = '';
		
		if( !empty($breadcrumb))
		{
			foreach($breadcrumb as $v)
			{
				$list .= '<li><a href="'.$v['url'].'/">'.$v['name'].'</a></li>';
			}
		}
		
		$main = '<ol class="breadcrumb"><li><a href="'.$url.'"><i class="fa fa-dashboard"></i> Home</a>'.$list.'</ol>';
		
		return $main;
	}
}

if ( ! function_exists('url_title'))
{
	function url_title ($str, $separator = 'dash', $lowercase = true) {
		if ( $separator == 'dash' ) {
			$search = '_';
			$replace = '-';
		}
		else {
			$search = '-';
			$replace = '_';
		}

		$trans = array(
			'&\#\d+?;' => '',
			'&\S+?;' => '',
			'\s+' => $replace,
			'[^a-z0-9\-\._]' => '',
			$replace . '+' => $replace,
			$replace . '$' => $replace,
			'^' . $replace => $replace,
			'\.+$' => ''
		);

		$str = strip_tags($str);

		foreach ( $trans as $key => $val ) {
			$str = preg_replace("#" . $key . "#i", $val, $str);
		}

		if ( $lowercase === true ) {
			$str = strtolower($str);
		}

		return trim(stripslashes(str_replace(array( ',', '.' ), array( '', '' ), $str)));
	}
}


?>