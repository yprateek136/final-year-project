<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
* Function : resizeImage
*
*/
function resizeImage($filename, $width=250, $height=650, $path='attachments/hostel_gallery')
	{
	$source_path = $_SERVER['DOCUMENT_ROOT'] . '/hospital/'. $path.'/'. $filename;
	$target_path = $_SERVER['DOCUMENT_ROOT'] . '/hospital/'.$path.'/thumbnail/';
	$config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '',
          'width' => $width,
          'height' => $height

    );
	
	$CI =& get_instance();
  	$CI->load->library('image_lib', $config_manip);
	if (!$CI->image_lib->resize()) {
        $CI->image_lib->display_errors();
     }
		$CI->image_lib->clear();

 }
	/*
	* Function : validate_session
	*/
	function validate_session()
	{
		
		if($_SESSION['admin_login']=='')
		{
			redirect('adminlogin');
		} 
			
	}

	
	/*
	* Function : validate_user_session
	*/
	function validate_user_session()
	{
		
		if($_SESSION['user_login']=='')
		{
			redirect('userlogin');
		}			
	}
	/*
	* Function : findage
	*/
	function findage($dob)
	{
				
		//An example date of birth.
		$dobArray = explode('/',$dob);
		$userDob = $dobArray[2].'-'.$dobArray[1].'-'.$dobArray[0];
		 
		//Create a DateTime object using the user's date of birth.
		$dob = new DateTime($userDob);
		 
		//We need to compare the user's date of birth with today's date.
		$now = new DateTime();
		 
		//Calculate the time difference between the two dates.
		$difference = $now->diff($dob);
		 
		//Get the difference in years, as we are looking for the user's age.
		$age = $difference->y;
		 
		return $age;
	}


function remove_html_tags($string)
{
  return  preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($string)));
} 

function except_letters($string)
{
   // $onlyLetters = mb_ereg_replace('[^\\p{L}\s]', '', $string);
    $onlyLetters = preg_replace('/([\s])\1+/', ' ', $onlyLetters);
    $onlyLetters = preg_replace('/\s/', '_', trim($onlyLetters));
    return $onlyLetters;
}

function allletters_lowercase($string)
{
	$only_lowercase = strtolower($string);
	return replaceblankspace($only_lowercase);
}


function firstletterCapital($string)
{
	$ucwords = ucwords(strtolower($string));
	return $ucwords;
}


function striphtmltags($string)
{
	$removeallhtmlchar = strip_tags($string);
	return $removeallhtmlchar;
}


function replaceblankspace($string)
{
	$only_replaceblankspace = str_replace(" ","-",$string);
	return $only_replaceblankspace;
}

function replaceblankspacewith($string)
{
	$only_replaceblankspace = str_replace(" ","+",$string);
	return $only_replaceblankspace;
}

function setcharlimit($string, $limit=15, $start=0)
{
	$return_string = '';
	$return_string .= substr(html_entity_decode($string),$start,$limit);
	if(strlen($string)>$limit) {
		$return_string .= '...';
	}
	return $return_string;
}

/*
* Function : Get Default Image Name
*/

function getDefaultImage($string)
{
	$response = '';
	$stringArray = explode(" ",$string);
	if(count($stringArray)>=2)
	{
		$response = substr($stringArray[0],0,1).''.substr($stringArray[1],0,1);
	} else {
		$response = substr($string,0,2);
	}
	
	return '<span class="frist-letter">'.strtoupper($response).'</span>';
}

function splitArrayAlphabetOrder($records)
{
	
    $temp=array();    
    $first_char="";
    for($i=0;$i<count($records);$i++)
    {
        $first_char= strtoupper ($records[$i][0]);             
             if(!in_array($first_char, $temp))
             {
                 echo strtoupper($first_char).'<br>'; //print A / B / C etc                      

             }
             $temp[]=  $first_char;
            echo $records[$i]."<br>";
    }


}

	function valid_seo_friendly_url($string){
			$string = str_replace(array('[\', \']',"’",":",";","|","%","@","$","^","*","(",")","?","&","<",">",",",".","/","--"), '', $string);
			$string = preg_replace('/\[.*\]/U', '', $string);
			$string = htmlentities($string, ENT_COMPAT, 'utf-8');
			$string = strtolower(str_replace(" ","-",$string));
			return cleanString(trim($string, '-'));
	}
	
	function seo_friendly_url($string){
			$string = str_replace(array('[\', \']',"’",":"), '', $string);
			$string = preg_replace('/\[.*\]/U', '', $string);
			$string = htmlentities($string, ENT_COMPAT, 'utf-8');
			return cleanString(trim($string, '-'));
	}
	
	function seo_friendly_url_desc($string){
			$string = str_replace(array('[\', \']',"’"), '', $string);
			$string = preg_replace('/\[.*\]/U', '', $string);
			$string = htmlentities($string, ENT_COMPAT, 'utf-8');
			return cleanString(trim($string, '-'));
	}	
	
	function stripTags($text) {
		return str_replace(array('<p>','</p>',"’","&nbsp;","<div>","</div>"),'',strip_tags(cleanString($text)));
	}
	function cleanString($text) {
		$utf8 = array(
			'/[áàâãªä]/u'   =>   'a',
			'/[ÁÀÂÃÄ]/u'    =>   'A',
			'/[ÍÌÎÏ]/u'     =>   'I',
			'/[íìîï]/u'     =>   'i',
			'/[éèêë]/u'     =>   'e',
			'/[ÉÈÊË]/u'     =>   'E',
			'/[óòôõºö]/u'   =>   'o',
			'/[ÓÒÔÕÖ]/u'    =>   'O',
			'/[úùûü]/u'     =>   'u',
			'/[ÚÙÛÜ]/u'     =>   'U',
			'/ç/'           =>   'c',
			'/Ç/'           =>   'C',
			'/ñ/'           =>   'n',
			'/Ñ/'           =>   'N',
			'/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
			'/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
			'/[“”«»„]/u'    =>   ' ', // Double quote
			'/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
		);
		return preg_replace(array_keys($utf8), array_values($utf8), $text);
	}