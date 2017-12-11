<?php

function echoPre($ret)
{
	echo "<pre>";print_r($ret);echo "</pre>";
}

function StrToUcfirst( $str ='' )
{
	if( $str )
	{
		$ret = ucwords(strtolower($str));
	}else{
		$ret = '';
	}
	return $ret;
}

function TglIndo($tanggal)
{
	$taketgl = substr($tanggal, 0,10);
	$tahun = substr($taketgl, 0,4);
	$bulan = substr($taketgl, 5,2);
	$tanggal = substr($taketgl, 8,2);

	if($bulan=='01') $bulan = 'Januari';
	if($bulan=='02') $bulan = 'Februari';
	if($bulan=='03') $bulan = 'Maret';
	if($bulan=='04') $bulan = 'April';
	if($bulan=='05') $bulan = 'Mei';
	if($bulan=='06') $bulan = 'Juni';
	if($bulan=='07') $bulan = 'Juli';
	if($bulan=='08') $bulan = 'Agustus';
	if($bulan=='09') $bulan = 'September';
	if($bulan=='10') $bulan = 'Oktober';
	if($bulan=='11') $bulan = 'November';
	if($bulan=='12') $bulan = 'Desember';

	$tgl = $tanggal." ".$bulan." ".$tahun;

return $tgl;
}

if ( !function_exists('formatDate') ) {
    
    function formatDate ($date, $format = 'd M Y')
    {
    	$return = date( $format, strtotime($date));
		
		return $return;
    }
}

if ( !function_exists('limit_words') ) {
    
    /**
     * limit_words()
     *
     * @param mixed $string
     * @param integer $word_limit
     * @param string $end_char
     * @return
     */
     
    function limit_words ($string, $word_limit, $end_char = '&#8230;')
    {
    	$string = preg_replace("/\s+/", ' ', str_replace(array( "\r\n", "\r", "\n" ), ' ', $string));
        $words = explode(" ",$string);
    	if(count($words) <= $word_limit )
    	{
    		return $string;
    	}else{
    		$result = implode(" ",array_splice($words, 0, $word_limit));
    		return $result." ".$end_char;
    	}
    }
}

if ( !function_exists('character_limiter') ) {

    /**
     * character_limiter()
     *
     * @param mixed $str
     * @param integer $n
     * @param string $end_char
     * @return
     */
    function character_limiter ($str, $n = 500, $end_char = '&#8230;') {
        if ( strlen($str) < $n ) {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array( "\r\n", "\r", "\n" ), ' ', $str));

        if ( strlen($str) <= $n ) {
            return $str;
        }

        $out = "";
        foreach ( explode(' ', trim($str)) as $val ) {
            $out .= $val . ' ';

            if ( strlen($out) >= $n ) {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
    }

}


/**
 * FORMAT CURRENCY
 * @param $nominal(FLOAT)
 * @return $nominal_formated (STRING) 
**/
function formatCurrency($nominal)
{
    $nominal_formated = is_numeric($nominal) ? number_format($nominal, 0, ',', '.') : '';
    
    return $nominal_formated;
}

/**
 *
 * update from mdk
 *
 */
/*function formatDate($date = '', $mode = '3', $showTime = true, $sep = ' ') {
    $year = intval(substr($date, 0, 4));
    $month = intval(substr($date, 5, 2)) - 1;
    $day = intval(substr($date, 8, 2));
    $time = ($showTime) ? ' ' . substr($date, 11) : '';
    $dow = date('w', mktime(0, 0, 0, (int) $month + 1, (int) $day-1, (int) $year));
    $dayname = '';

    if ($mode == '1') {         //dd mmmm yyyy
	$month = isset($GLOBALS['month_short'][$month]) ? $GLOBALS['month_short'][$month] : "";
    } elseif ($mode == '2') {    //dd mmm yyyy
	$month = isset($GLOBALS['month_short'][$month]) ? $GLOBALS['month_short'][$month] : "";
    } elseif ($mode == '3') {    //dddd, dd mmmm yyyy
	$month = isset($GLOBALS['month_long'][$month]) ? $GLOBALS['month_long'][$month] : "";
	$dayname = isset($GLOBALS['day_long'][$dow]) ? $GLOBALS['day_long'][$dow] . ', ' : "";
    } elseif ($mode == '4') {    //dddd, dd mmm yyyy
	$month = isset($GLOBALS['month_short'][$month]) ? $GLOBALS['month_short'][$month] : "";
	$dayname = isset($GLOBALS['day_long'][$dow]) ? $GLOBALS['day_long'][$dow] . ', ' : "";
    } elseif ($mode == '5') {    //dddd, dd mm yyyy
	$dayname = isset($GLOBALS['day_long'][$dow]) ? $GLOBALS['day_long'][$dow] . ', ' : "";
    } elseif ($mode == '6') {    //ddd, dd mmmm yyyy
	$month = isset($GLOBALS['month_long'][$month]) ? $GLOBALS['month_long'][$month] : "";
	$dayname = isset($GLOBALS['day_short'][$dow]) ? $GLOBALS['day_short'][$dow] . ', ' : "";
    } elseif ($mode == '7') {    //ddd, dd mmm yyyy
	$month = isset($GLOBALS['month_short'][$month]) ? $GLOBALS['month_short'][$month] : "";
	$dayname = isset($GLOBALS['day_short'][$dow]) ? $GLOBALS['day_short'][$dow] . ', ' : "";
    } elseif ($mode == '8') {    //ddd, dd mm yyyy
	$dayname = isset($GLOBALS['day_short'][$dow]) ? $GLOBALS['day_short'][$dow] . ', ' : "";
    } elseif ($mode == '9') {    //hh:mm
	$dayname = $day = $month = $year = $sep = '';
	$time = substr($time, 1, 5);
    } elseif ($mode == '10') {    //dd mm yyyy
	$month = str_pad($month, 2, "0", STR_PAD_LEFT)+1;
	$day = str_pad($day, 2, "0", STR_PAD_LEFT);
    } elseif ($mode == '11') {    //dd mmm
	$month = isset($GLOBALS['month_short'][$month]) ? $GLOBALS['month_short'][$month] : "";
	$day = str_pad($day, 2, "0", STR_PAD_LEFT);
		    $year = '';
    } elseif ($mode == '12') {    //mmmm yyyy
	$month = isset($GLOBALS['month_long'][$month]) ? $GLOBALS['month_long'][$month] : "";
		    $day = '';
    } elseif ($mode == '13') {    //mmm yyyy
	$month = isset($GLOBALS['month_short'][$month]) ? $GLOBALS['month_short'][$month] : "";
		    $day = '';
    }

    return $dayname . $day . $sep . $month . $sep . $year . $time;
}
*/
function mkdir_r ($dirName, $rights = 0777) {
    $dirs = explode('/', $dirName);
    $dir = '';
    foreach ( $dirs as $part ) {
        $pos = strpos($part, ".");
        if ( $pos === false ) {
            $dir.=$part . '/';
        }
        if ( !is_dir($dir) && strlen($dir) > 0 ) {
            mkdir($dir, $rights);
        }
    }
}

function getIP () {
    if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

if ( !function_exists('send_email') ) {

    /**
     * ubah ke global, masih pakai punya CLEAR
     */
    function send_email ($to, $subject, $body, $returnResult=false, $attachment=null) {
        include_once (BASE_PATH . 'libraries/phpmailer.php');

        $mail = new PHPMailer();

        $mail->IsMail();
        $mail->IsHTML(true);

        $mail->Host = 'localhost';
        $mail->Port = 9267;
        $mail->From = 'nobody@kapanlagi.net';
        $mail->FromName = 'Hemat.com';
        
        //Recepient
        if ($to)
        {
            if (is_array($to))
            {
                foreach($to as $r)
                {
                    $mail->AddAddress($r);
                }
            }
            else
            {
                $mail->AddAddress($to);
            }
        }
        
        
        #$mail->AddAddress($to);

        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = preg_replace("/<br\s?\/*>/si", "\n", $body);
        
        if ( $attachment )
        {
            if ( is_array($attachment) && !empty($attachment) )
            {
                foreach( $attachment as $file )
                {
                    $mail->AddAttachment($file);
                }
            }
            else
            {
                $mail->AddAttachment($attachment);
            }
        }

        $send = $mail->Send();
        if($returnResult) return $send;
    }

}

if ( !function_exists('createPdf') ) {

    function createPdf ( $html = '' , $author = '', $title = '', $subject = '') {
        
		#$this->load->library('Pdf');
		include_once (FCPATH . 'application/libraries/Pdf.php');
		
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($auhtor);
		$pdf->SetTitle($title);
		$pdf->SetSubject($subject);

		//set margin
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(10);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		
		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		 
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set font
		$pdf->SetFont('helvetica', '', 10);

		// add a page
		$pdf->AddPage();
		
		// create some HTML content
		#print_r($html);exit;
		$pdf->writeHTML($html, false, false, false, false, '');

		ob_clean();
		$pdf->Output($title, 'I');
		
		
    }

}




?>