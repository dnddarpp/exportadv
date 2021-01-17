<?
    require_once('db.inc.php');
    require_once('attachment.inc.php');

    list($mime, $content) = db_row('select mime, content from khb_attachment where id=?', [$_SERVER['KEY']]);
    output_image($mime, $content, (int) $_GET['w'], (int) $_GET['h'], isset($_GET['cover']));
