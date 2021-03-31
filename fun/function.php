<?php

function qury_sel($sql, $conn){
	$result = $conn->query($sql) or die('select error: '.mysqli_error());
	return $result;
}

function qury_one($sql, $conn){
	$result = $conn->query($sql) or die('query one error: '.mysqli_error());
	$num = mysqli_fetch_array($result, MYSQLI_NUM);
	return $num[0];
}

function qury_non($sql, $conn){
	$result = $conn->query($sql) or die("query error: ".mysqli_error());
	return true;
}

function qury_rows($sql, $conn){
    $result = $conn->query($sql) or die('mysql select error:'.mysqli_error());
    return mysqli_num_rows($result);
}

function alert_and_go( $alert, $go ){

	echo "<script type='text/javascript'>alert('".$alert."'); location.assign('".$go."');</script>";

}

function just_go( $go ){

	echo "<script type='text/javascript'>location.assign('".$go."');</script>";

}

function insert_hash($table, $data, $conn){
        $key = array();
        $val = array();
        foreach( $data as $k => $v ){
            $key[] = "`$k`";
            if( $v===null )
                $val[] = 'NULL';
            else
                $val[] = "'".mysqli_real_escape_string($conn ,$v)."'";
        }
        $key = implode(',', $key);
        $val = implode(',', $val);
        return $conn->query("insert into $table ($key) values ($val)") or die("insert_hash error: ".mysqli_error());
}

function update_hash($table, $where, $data, $conn){
        $set = array();
        foreach( $data as $k => $v ){
            if( $v===null )
                $set[] = "`$k`=NULL";
            else
                $set[] = "`$k`='".mysqli_real_escape_string($conn, $v )."'";
        }
        $set = implode(',', $set);
//        echo "update $table set $set where $where";
        return $conn->query("update $table set $set where 1=1 and $where") or die("update_hash error: ".mysqli_error());
}

function get_option( $array, $select ){
	$option = "";
	foreach( $array as $k => $v ){
		$s = "";
		if( $k == $select )
			$s = "selected='selected'";
		$option .= "<option value='$k' $s>$v</option>";
	}
	return $option;
}

function array2url ( $arr ){
	$arr2 = array();
	foreach( $arr as $key => $value ){
		$arr2[] = $key."=".$value ;
	}
	return implode( "&", $arr2 );
}

function isInDB( $field, $value, $table, $conn ){
	$sql = "SELECT COUNT(*) FROM `$table` WHERE 1=1 and `$field`='$value'";
	if( qury_one( $sql, $conn ) == '0' )
		return false;
	else
		return true;
}

function utf8_str_split($str, $split_len = 1)
{
    if (!preg_match('/^[0-9]+$/', $split_len) || $split_len < 1)
        return FALSE;

    $len = mb_strlen($str, 'UTF-8');
    if ($len <= $split_len)
        return array($str);

    preg_match_all('/.{'.$split_len.'}|[^\x00]{1,'.$split_len.'}$/us', $str, $ar);
    return $ar[0];
}

function mbstringtoarray($str,$charset) {

  $strlen=mb_strlen($str);
  while($strlen){
    $array[]=mb_substr($str,0,1,$charset);
    $str=mb_substr($str,1,$strlen,$charset);
    $strlen=mb_strlen($str);
  }
  return $array;

}

function utf8_substr($StrInput,$strStart,$strLen){

//對字串做URL Eecode

$StrInput = mb_substr($StrInput,$strStart,mb_strlen($StrInput));
$iString = urlencode($StrInput);
$lstrResult="";
$istrLen = 0;
$k = 0;
	do{
		$lstrChar = substr($iString, $k, 1);

		if($lstrChar == "%"){
			$ThisChr = hexdec(substr($iString, $k+1, 2));
			if($ThisChr >= 128){
				if($istrLen+3 < $strLen){
					$lstrResult .= urldecode(substr($iString, $k, 9));
					$k = $k + 9;
					$istrLen+=3;
				}else{
					$k = $k + 9;
					$istrLen+=3;
				}
			}else{
				$lstrResult .= urldecode(substr($iString, $k, 3));
				$k = $k + 3;
				$istrLen+=2;
			}
		}else{
			$lstrResult .= urldecode(substr($iString, $k, 1));
			$k = $k + 1;
			$istrLen++;
		}
	}
	while ($k < strlen($iString) && $istrLen < $strLen);

	return $lstrResult;

}

function getClientIP(){
    if ($_SERVER["HTTP_X_FORWARDED_FOR"]){
        if ($_SERVER["HTTP_CLIENT_IP"]){
	        $proxy = $_SERVER["HTTP_CLIENT_IP"];
        }else{
					$proxy = $_SERVER["REMOTE_ADDR"];
        }
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }else{

        if ($_SERVER["HTTP_CLIENT_IP"])
        {
        	$ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        else
        {
					$ip = $_SERVER["REMOTE_ADDR"];
        }
    }
    return $ip;
}

function br2nl($text){
    return preg_replace('/<br\\s*?\/??>/i','',$text);
}

function dateTo_c($in_date, $in_txt="")
{

    $ch_date = explode("-", $in_date);
    $ch_date[0] = $ch_date[0]-1911;
    $date = '00.00.00';
    if ($in_txt=="")
    {
        $date = '000000';
        if ($ch_date[0] > 0 ) $date = $ch_date[0]."".$ch_date[1]."".$ch_date[2];
    }
    else
    {
        if ($ch_date[0] > 0 ) $date = $ch_date[0]."$in_txt".$ch_date[1]."$in_txt".$ch_date[2];
    }

    return $date;
}
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

class ResizeImage {

 var $image;

 var $image_type_id;

 function load($filename) {

     //取得圖片資訊

     $image_info = getimagesize($filename);

     //取得圖片類型

     $this -> image_type_id = $image_info[2];

     //判斷圖片類型，並建立圖片物件

     if( $this -> image_type_id == IMAGETYPE_JPEG ) {

         $this -> image = imagecreatefromjpeg($filename);

     }

     elseif( $this -> image_type_id == IMAGETYPE_GIF ) {

         $this -> image = imagecreatefromgif($filename);

     }

     elseif( $this -> image_type_id == IMAGETYPE_PNG )

     {

         $this -> image = imagecreatefrompng($filename);

     }

 }



 function save($filename, $image_type_id = IMAGETYPE_JPEG) {

     if( $image_type_id == IMAGETYPE_JPEG ) {

         imagejpeg($this -> image,$filename,75);

     }

     elseif( $image_type_id == IMAGETYPE_GIF ) {

         imagegif($this -> image,$filename);

     }

     elseif( $image_type_id == IMAGETYPE_PNG ) {

         imagepng($this -> image,$filename);

     }

     //修改權限

     chmod($filename,0755);

 }



 function getWidth() {

     //取得寬度

     return imagesx($this -> image);

 }

 function getHeight() {

     //取得高度

     return imagesy($this -> image);

 }

 function resizeToHeight($height) {

     //高度縮放(寬度等比縮放)

     $ratio = $height / $this -> getHeight();

     $width = $this -> getWidth() * $ratio;

     $this->resize($width,$height);

 }



 function resizeToWidth($width) {

     //寬度縮放(高度等比縮放)

     $ratio = $width / $this -> getWidth();

     $height = $this -> getheight() * $ratio;

     $this->resize($width,$height);

 }



 function scale($scale) {

     //百分比縮放

     $width = $this -> getWidth() * $scale/100;

     $height = $this -> getheight() * $scale/100;

     $this->resize($width,$height);

 }



 function resize($width,$height) {

     //imagecreatetruecolor會產生特定長寬的黑色圖形，並建立圖片物件

     $new_image = imagecreatetruecolor($width, $height);

     //利用imagecopyresampled resize圖片

     //imagecopyresampled(目地圖片,來源圖片,目地x座標,目地y座標,來源x座標,來源y座標,目地寬度,目地高度,來源寬度,來源高度)

     imagecopyresampled($new_image, $this -> image, 0, 0, 0, 0, $width, $height, $this -> getWidth(), $this -> getHeight());

     //將image變數指向新的圖片

     $this -> image = $new_image;

 }

}



function getConsultData($_id,$conn){
	$str="";
	$ary = array();
	$sql= "select *  from `consult` where 1=1 and parent=".$_id;
	$pjdata = qury_sel($sql, $conn);
	while($data = mysqli_fetch_assoc($pjdata)) {
		$id = $data["id"];
		$end = $data["endpage"];
		if($end=="0"){
			$subary = getConsultData($id,$conn);
			//echo "ccc";
			$ary[]=array("title"=>$data["title"], "id"=>$id, "content"=>$subary);
		}else{
			$ary[]=array("title"=>$data["title"], "id"=>$id, "content"=>array());
		}
		//$str.=$id .":".$data["title"]."<br>";
	}
	return $ary;
}
function getConsultPath($_id,$conn,$_ary){
	// echo "id:".$_id."  :".json_encode($_ary)."<br>";
	if($_id!="0"){
		$sql= "select *  from `consult` where 1=1 and id=".$_id;
		$pjdata = qury_sel($sql, $conn);
		$data = mysqli_fetch_assoc($pjdata);
		$parent = $data["parent"];
		//echo "parent:".$parent;
		$_ary[] = array($data["id"],$data["title"]);
		$_ary = getConsultPath($parent,$conn,$_ary);
	}
	return $_ary;
}
function setSelect($_ary,$_layer){
	$_layer++;
	$space = "";
	for($i=1;$i<=$_layer;$i++){
		$space.="&nbsp;&nbsp;";
	}
	foreach ($_ary as $item) {
		$title = $item["title"];
		$id = $item["id"];
		//echo $id.':'.$title."<br>";
		//echo json_encode($item)."<br>";

		echo '<option value="'.$id.'">'.$space.$title.'</option>';
		setSelect($item["content"],$_layer);
	}
}

function trackConsult($_id, $conn){
	$sql = "INSERT INTO consult_log (consult_id) VALUES ($_id)";

if (mysqli_query($conn, $sql)) {
  $last_id = mysqli_insert_id($conn);
  return $last_id;
} else {
  return "Error: " . $sql . "<br>" . mysqli_error($conn);
}
	//mysqli_close($conn);
}

function insertFeedback($_id,$_trackid, $feed, $conn){
	$data = array(
		'consult_id'=>$_id,
		'track_id'=>$_trackid,
		'feed'=>$feed,
	);
	insert_hash( 'consult_feedback', $data, $conn );
}
?>
