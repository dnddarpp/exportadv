<?php
require_once("include.php");

$sql = "select a.*, b.catename from `page` as a inner join page_cate as b on a.type = b.id where 1=1 and a.id = 1 ";
$pjdata = qury_sel($sql, $conn);
$data = mysqli_fetch_assoc($pjdata);
$banner = "images/banner_02.png";

?>
<!DOCTYPE html>
<html>
   <head>
      <?php require_once('i_meta.php'); ?>
      <title>免費諮詢</title>
   </head>
   <body >
      <?php require_once('i_header.php'); ?>
      <?php require_once('i_pagecontent.php'); ?>
      <?php require_once('i_bottom.php'); ?>
   </body>
</html>
