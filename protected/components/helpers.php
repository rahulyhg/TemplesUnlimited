<?php 
class helpers{
	public static function render_image($image,$attr = array()){
	  
      $userfile_extn = substr($image, strrpos($image, '.')+1);
	  if(isset($userfile_extn) && strrpos($image, '.')){
	 
		if(strtolower($userfile_extn) == 'pdf'){
		/*$im = new imagick('file.pdf[0]');
		$im->setImageFormat('jpg');
		header('Content-Type: image/jpeg');
		return $im;*/
		 //Yii::import('application.extensions.image.Image');
		//$image_new = new Image('1393922691MBTLA2_OI.pdf');
		//$image_new->resize(100, 100)->rotate(-45)->quality(75)->sharpen(20);
		//return $image_new->render();
		
		
		return '<a href= "'.$image.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf.png', '',$attr).'</a>';
		}else if(strtolower($userfile_extn) == 'mp4' || strtolower($userfile_extn) == 'avi' || strtolower($userfile_extn) == 'flv' || strtolower($userfile_extn) == '3gp'){
	
		return '<a href= "'.$image.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'video.png', '',$attr).'</a>';
		}else if(strtolower($userfile_extn) == 'docx' || strtolower($userfile_extn) == 'doc'){
	
		return '<a href= "'.$image.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'DOC.png', '',$attr).'</a>';
		}else{
		  if(in_array(strtolower($userfile_extn),array('png','jpg','jpeg','bmp','gif')))
		   return '<a href= "'.$image.'"  target="_blank">'.CHtml::image($image, '',$attr).'</a>';
		   else
		   return '<a href= "'.Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg'.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg', '',$attr).'</a>';
	   }
	}else
	 return '<a href= "'.Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg'.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg', '',$attr).'</a>';
}	




    public static function render_image_without_link($image,$attr = array()){
	  
      $userfile_extn = substr($image, strrpos($image, '.')+1);
	  if(isset($userfile_extn) && strrpos($image, '.')){
	 
		if(strtolower($userfile_extn) == 'pdf'){
		/*$im = new imagick('file.pdf[0]');
		$im->setImageFormat('jpg');
		header('Content-Type: image/jpeg');
		return $im;*/
		 //Yii::import('application.extensions.image.Image');
		//$image_new = new Image('1393922691MBTLA2_OI.pdf');
		//$image_new->resize(100, 100)->rotate(-45)->quality(75)->sharpen(20);
		//return $image_new->render();
		
		
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf.png', '',$attr);
		}else{
		  if(!is_dir($image))
		   return CHtml::image($image, '',$attr);
		   else
		   return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg', '',$attr);
	   }
	}else
	 return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg', '',$attr);
}	
	
	public static function  metertokilometer($meter){
	   return round(($meter/1000), 2);
	}
	
	public static function  kilometertometer($meter){
	   return round(($meter*1000), 2);
	}
	
	
	public static  function get_company_fees($amount){
	    $fees = 0;
		$tax = 0;
		$feespercentage = 0;
		if((float)$amount<=300)
		$feespercentage = 10;
		else if((float)$amount > 300 && (float)$amount<=600)
		$feespercentage = 9;
	    else if((float)$amount > 600 && (float)$amount<=1500)
		$feespercentage = 8;
		else if((float)$amount > 1500)
		$feespercentage = 7;
		
		$fees  = round((float)$amount*(float)((float)$feespercentage / 100),2);
		$fees = ((float)$fees<5)?5:$fees;
		$tax  = round((float)$fees*0.10,2);
		$tax  = ((float)$tax<0.5)?0.50:$tax;
		$total  = round((float)$fees+(float)$tax,2);
		$fesdetails = array('subtotal'=>(float)$fees,'tax'=>(float)$tax,'total'=>(float)$total);
		return $fesdetails;
	}
	
	
	public static  function to_currency($amount){
	return 'Rs '.$amount;
	}
	
	public static  function configs(){
	$configs = Config::model()->findByPK('1');
	return $configs;
	}
	
	public static  function sitefullbaseurl(){
	return str_replace('index.php','',Yii::app()->createAbsoluteUrl('/'));
	//return 'http://livedemo.blazewebtech.com/LEXgo/';
	}
	
	public static  function change_date_format($date){
	return date('d/m/Y',strtotime($date));
	//return 'http://livedemo.blazewebtech.com/LEXgo/';
	}
	
	public static  function get_server_protocol(){
	return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	}

   public static  function encrypt_password($password){
	  return md5($password);
	}
	
	public static	function simple_encrypt($str){
	    return  base64_encode($str);
	}
	
	public static function simple_decrypt($str){
	    return  base64_decode($str);
	}
	
	public static function show_desc($desc){
	   return (strlen($desc)>100)?substr($desc,0,100).'...':$desc;
	}
	
	public static function show_minimize($string,$size){
	   return (strlen($string)>$size)?substr($string,0,$size).'...':$string;
	}
	
	public static function view_image($image,$attr = array()){
	 $userfile_extn = substr($image, strrpos($image, '.')+1);
	  if(isset($userfile_extn) && strrpos($image, '.')){
	    if(in_array(strtolower($userfile_extn),array('png','jpg','jpeg','bmp','gif'))){
		$alt = '';
		if(isset($attr['alt']))
		$alt =$attr['alt'];
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image,$alt,$attr);
		}else if(strtolower($userfile_extn) == 'pdf'){
		return '<a href= "'.$image.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf.png', '',$attr).'</a>';
		}else if(strtolower($userfile_extn) == 'mp4' || strtolower($userfile_extn) == 'avi' || strtolower($userfile_extn) == 'flv' || strtolower($userfile_extn) == '3gp'){
		return '<a href= "'.$image.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'video.png', '',$attr).'</a>';
		}else if(strtolower($userfile_extn) == 'docx' || strtolower($userfile_extn) == 'doc'){
		return '<a href= "'.$image.'"  target="_blank">'.CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'DOC.png', '',$attr).'</a>';
		}else
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	  }else{
	    return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	  }
	  // return (strlen($image)>5)?CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image):CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	}
	
	public static function view_userimage($image,$type='main',$attr = array()){
	 $userfile_extn = substr($image, strrpos($image, '.')+1);
	  if(isset($userfile_extn) && strrpos($image, '.')){
	    if(in_array(strtolower($userfile_extn),array('png','jpg','jpeg','bmp','gif'))){
		if($type== 'thumb'){
		  $image = str_replace('uploads/users/','uploads/users/thumb/',$image);
		}
			$alt = '';
		if(isset($attr['alt']))
		$alt =$attr['alt'];
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image,$alt,$attr);
		}else
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.'user.png','',$attr);
	  }else{
	    return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.'user.png','',$attr);
	  }
	  // return (strlen($image)>5)?CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image):CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	}
	
		public static function view_thumb($image,$attr = array()){
	 $userfile_extn = substr($image, strrpos($image, '.')+1);
	  if(isset($userfile_extn) && strrpos($image, '.')){
	    if(in_array(strtolower($userfile_extn),array('png','jpg','jpeg','bmp','gif'))){
		$image = str_replace(basename($image),'thumb/'.basename($image),$image);
		$alt = '';
		if(isset($attr['alt']))
		$alt =$attr['alt'];
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image,$alt,$attr);
		}else
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	  }else{
	    return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	  }
	  // return (strlen($image)>5)?CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image):CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	}
	
	public static function view_thumb150($image,$attr = array()){
	 $userfile_extn = substr($image, strrpos($image, '.')+1);
	  if(isset($userfile_extn) && strrpos($image, '.')){
	    if(in_array(strtolower($userfile_extn),array('png','jpg','jpeg','bmp','gif'))){
		$image = 'uploads/users/thumb150/'.basename($image);
		$alt = '';
		if(isset($attr['alt']))
		$alt =$attr['alt'];
		if(file_exists($image))
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image,$alt,$attr);
		else
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.'user.png','',$attr);
		}else
		return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.'user.png','',$attr);
	  }else{
	    return CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.'user.png','',$attr);
	  }
	  // return (strlen($image)>5)?CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$image):CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'no_image.jpg','',$attr);
	}
	

	
	public static function isadmin(){
	   if(!Yii::app()->user->isGuest &&  Yii::app()->user->getState('roles') == 'main')
	   return true;
	   else
	    return false;
	}
	
	public static function isnormaluser(){
	   if(!Yii::app()->user->isGuest &&  Yii::app()->user->getState('roles') == 'normal')
	   return true;
	   else
	    return false;
	}
	
	public static function isiyer(){
	
	   if(!Yii::app()->user->isGuest &&  Yii::app()->user->getState('roles') == 'iyer')
	   return true;
	   else
	    return false;
	}
	
	public static function isguide(){
	   if(!Yii::app()->user->isGuest &&  Yii::app()->user->getState('roles') == 'guide')
	   return true;
	   else
	    return false;
	}
	
	// Get lat/long co-ords
		public static function getLatLong($address) {
				
			$address = str_replace(' ', '+', $address);
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&travel_mode=driving&sensor=false';
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$geoloc = curl_exec($ch);
			$json = json_decode($geoloc);
		    if(isset($json->status) && strtolower($json->status) == 'ok' && isset($json->results) && count($json->results) && isset($json->results[0]->geometry)){
			return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);
			}else{
			  $addressarr = explode(',',$address);
			  if(count($addressarr) && count($addressarr)>1){
			     unset($addressarr[count($addressarr)-1]);
				 $this->getLatLong(implode(',',$addressarr));
			  }else
			  return array('','');
			}
			
		}

}
?>
