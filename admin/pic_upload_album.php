<?php
require_once("noscreen_top.php");
// $target_dir = "pic/album/".$uniqid;
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {

  // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  // if($check !== false) {
  //   echo "File is an image - " . $check["mime"] . ".";
  //   $uploadOk = 1;
  // } else {
  //   echo "File is not an image.";
  //   $uploadOk = 0;
  // }

  $j = 0; //Variable for indexing uploaded image
  $picary = [];
  $uniqid = uniqid();
  $target_path = "../pic/album/".$uniqid."/"; //Declaring Path for uploaded images
  echo "CCCC:".count($_FILES['file']['name']);
  for ($i = 0; $i < count($_FILES['file']['name']); $i++) { //loop to get individual element from the array

      $validextensions = array("jpeg", "jpg", "png"); //Extensions which are allowed
      $ext = explode('.', basename($_FILES['file']['name'][$i])); //explode file name from dot(.)
      $file_extension = end($ext); //store extensions in the variable
      $filename = md5(uniqid()).".".$ext[count($ext) - 1];
      $picary[] = $filename;
      echo $filename;
      $target_path = $target_path.$filename; //set the target path with a new name of image
      $j = $j + 1; //increment the number of uploaded images according to the files in array

      if (($_FILES["file"]["size"][$i] < 2048000) //Approx. 100kb files can be uploaded.
          && in_array($file_extension, $validextensions)) {
          if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) { //if file moved to uploads folder
              echo $j.
              ').<span id="noerror">上傳成功</span><br/><br/>';
          } else { //if file was not moved.
              echo $j.
              ').<span id="error">發生錯誤！請再試一次。</span><br/><br/>';
          }
      } else { //if file size and file type was incorrect.
          echo $j.
          ').<span id="error">***檔案格式錯誤! 圖片必需小於2MB ***</span><br/><br/>';
      }
  }
  echo json_encode($picary);

// }else{
//   echo json_encode("nonono");
// }
?>
