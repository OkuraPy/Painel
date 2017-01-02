<?
set_time_limit(0);
include("config.php");
error_reporting(E_ALL);
$wallet = $mysqli->real_escape_string($_GET['wallet']);
$token = $mysqli->real_escape_string($_GET['token']);
$sql = $mysqli->query("SELECT token, active FROM downloads WHERE token='$token' AND active='0'");

			$update = $mysqli->query("UPDATE downloads SET active = '1' WHERE token= '$token'");
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-disposition: attachment; filename="'. $wallet. '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            ob_clean();
            flush();
            readfile('uploads/'.$wallet);
            exit;
?>