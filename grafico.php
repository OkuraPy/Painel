<?php
include("config.php");
$sth = $mysqli->query("SELECT COUNT(codigo) AS usuario FROM usuario");
$rows = array();
$rows['name'] = 'Usuarios';
while($r = mysqli_fetch_array($sth)) {
    $rows['data'][] = $r['usuario'];
}

$sth = $mysqli->query("SELECT COUNT(id) AS downloads FROM downloads");
$rows1 = array();
$rows1['name'] = 'Downloads';
while($rr = mysqli_fetch_assoc($sth)) {
    $rows1['data'][] = $rr['downloads'];
}

$result = array();
array_push($result,$rows);
array_push($result,$rows1);


print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($mysqli);
?>
