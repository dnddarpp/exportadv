<?
	require_once("noscreen_top.php");
    $call = $_POST['call'];
    $fail = $_POST['fail'];
	$obj = $_POST['obj'];
    if( $_FILES['file']['error']>0 ) {
	echo "<script>parent.$fail({$_FILES['file']['error']})</script>";
    }
    else {
	$path_info = pathinfo( $_FILES["file"]["name"] );
	$ext = $path_info["extension"];
	/* print_r( $path_info);
	echo "ext=".$ext."0000"; */
	if( $ext ) {
		$name = uniqid().".".$ext;
	  $filename = "../pic/link/".$name;

	    move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
	    chmod($filename, 0777);
/*		$imgresize = new resize_img();
		$imgresize->sizelimit_x = 100;
		$imgresize->sizelimit_y = 125;
		$imgresize->keep_proportions = true;
		$imgresize->toBigger = false;
		$imgresize->output = 'JPG';
		if( $imgresize->resize_image( $filename ) === false ){
			echo 'ERROR!';
		} else {
			$imgresize->save_resizedimage( "../pic/news/", $name );
		}
*/
//	    echo "<script>parent.$call('../pic/news/{$name}.jpg')</script>";
	    echo "<script>parent.$call('$name','$obj')</script>";
	}
	else {
	    echo "<script>parent.$fail('File Format Error')</script>";
	}
    }
?>
