<?
    require_once('db.inc.php');
    require_once('attachment.inc.php');

    list($mime, $content) = db_row('select mime, cover from food where id=?', [$_SERVER['ID']]);
    output_image($mime, $content, (int) $_GET['w'], (int) $_GET['h'], isset($_GET['cover']));
