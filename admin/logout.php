<?
session_start();
session_destroy();
?>
<script type="text/javascript">
	localStorage.removeItem('ADaccount');
	location.assign("https://exportadv.com.tw/admin/ADLogin/login.aspx");
</script>