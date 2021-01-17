<?
    require_once('attachment.inc.php');

    $content = file_get_contents('static/images/noimages.jpg');
    output_image('image/jpeg', $content, (int) $_GET['w'], (int) $_GET['h']);
