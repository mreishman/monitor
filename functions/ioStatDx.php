<?php
require_once("../core/php/commonFunctions.php");

function filterIoStatDx($dataInner)
{
	$dataInner = substr($dataInner, strpos($dataInner, "kB_wrtn")+8);
	$dataInner = substr($dataInner, strpos($dataInner, "kB_wrtn")+8);
	return $dataInner;
}

$testVar = shell_exec(" iostat -d");
if(is_null($testVar))
{
	echo json_encode(null);
	die();
}

$first = filterData(filterIoStatDx($testVar), 5);

sleep(1);

$second = filterData(filterIoStatDx(shell_exec(" iostat -d")),5);

echo json_encode(array($first, $second));
?>