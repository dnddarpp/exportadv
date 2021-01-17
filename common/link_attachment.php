<?
    require_once('db.inc.php');
    require_once('attachment.inc.php');

    list($mime, $content) = db_row('select mime, image from link where id=?', [$_SERVER['ID']]);
    output_image($mime, $content, (int) $_GET['w'], (int) $_GET['h']);
