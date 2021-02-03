<?
	require_once('include.php');
    $call = $_POST['call'];
    $fail = $_POST['fail'];
    if( $_FILES['file']['error']>0 ) {
			echo "<script>parent.$fail({$_FILES['file']['error']})</script>";
    }
    else {
			//$projectnum = $_SESSION["sandbox_projectnum"];
			$path_info = pathinfo( $_FILES["file"]["name"] );
			$ext = $path_info["extension"];

	if( $ext ) {
	    /*$filename = "../pic/news/".md5_file($_FILES["file"]["tmp_name"]).".".$ext;
	    $name = md5_file($_FILES["file"]["tmp_name"]);
	    move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
	    chmod($filename, 0755);*/
			$file_dir = "../files/file/";
			if (!file_exists($file_dir)) {
					mkdir($file_dir, 0777, true);
			}
			$filename = uniqid().".".$ext;
			$fullpath = $file_dir.$filename;
			move_uploaded_file($_FILES["file"]["tmp_name"], $fullpath);
			echo "<script>parent.$call('{$filename}')</script>";

	    //echo "<script>parent.$call('../pic/news/{$name}.jpg')</script>";
	    // echo "<script>parent.$call('$filename')</script>";
	}
	else {
	    echo "<script>parent.$fail('File Format Error')</script>";
	}
    }
?>
