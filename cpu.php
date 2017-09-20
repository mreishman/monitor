<?php

function clean_url($url) {
    $parts = parse_url($url);
    return $parts['path'];
}

require_once('statusTest.php');
$baseRedirect = "";
$baseRedirectTwo = "";
if($monitorStatus['withLogHog'] == 'true')
{
	$baseRedirect = "../";
	$baseRedirectTwo = "../";
}
$baseUrl = $baseRedirect."core/";
if(file_exists($baseRedirect.'local/layout.php'))
{
	$baseUrl = $baseRedirect."local/";
	//there is custom information, use this
	require_once($baseRedirect.'local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}
if(!file_exists($baseUrl.'conf/config.php') && $monitorStatus['withLogHog'] != 'true')
{
	$partOfUrl = clean_url($_SERVER['REQUEST_URI']);
	$url = "http://" . $_SERVER['HTTP_HOST'] .$partOfUrl ."setup/welcome.php";
	header('Location: ' . $url, true, 302);
	exit();
}
require_once($baseUrl.'conf/config.php'); 
require_once($baseRedirect.'core/conf/config.php');
require_once($baseUrl.'conf/topConfig.php'); 
require_once($baseRedirect.'core/conf/configTop.php');
require_once($baseRedirect.'core/php/loadVarsTop.php');
require_once($baseRedirect.'core/php/configStatic.php');

require_once($baseRedirect.'core/php/loadVars.php');

if($pollingRateOverviewMainType == 'Seconds')
{
	$pollingRateOverviewMain *= 1000;
}
if($pollingRateOverviewSlowType == 'Seconds')
{
	$pollingRateOverviewSlow *= 1000;
}

$useTop = false;
?>
<!doctype html>
<head>
	<title>Top | CPU</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>template/theme.css">
	<link rel="icon" type="image/png" href="<?php echo $baseRedirectTwo; ?>core/img/favicon.png" />
	<script src="<?php echo $baseRedirect; ?>core/js/jquery.js"></script>
	<?php if($monitorStatus['withLogHog'] == 'true'): ?>
		<style type="text/css">
		#menu a, .link, .linkSmall, .context-menu, .dropdown-content{
			background-color: <?php echo $currentSelectedThemeColorValues[0]?>;
		}
		</style>
	<?php endif; ?>
</head>
<body>

<?php require_once('header.php');?>	

	<div id="main">
		<table id="mainTable" width="100%">
			<tr>
				<td width="50%" valign="top" id="cpuAreaMultiCore">
					<img id="canvasMonitorLoading_CPU" style="position: fixed; top: 50%; left: 25%;" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				</td>
				<td width="50%" valign="top" id="processIds" style="background-color: #333;">
					<img id="canvasMonitorLoading_ProcessIds" style="position: fixed; top: 50%; right: 25%;"  src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				</td>
			</tr>
		</table>
	</div>
	<script type="text/javascript">
		var baseRedirect = "";
		<?php if($monitorStatus['withLogHog'] == 'true'): ?>
			baseRedirect = "../";
		<?php endif; ?>
	</script>
	<?php readfile($baseRedirect.'core/html/popup.html') ?>
	<script src="<?php echo $baseRedirect; ?>core/js/top.js"></script>

	<script type="text/javascript">

	var processFilterByRow = <?php echo $defaultProcessorSort;?>;
	var selectedUser = "USER";
	var baseForSystemTime = 0;
	var heightForPopup = 0;
	var widthForPopup = 0;
	var arrayForCpuMulti = new Array();

	function psAuxFunction()
	{
		if(!dropdownMenuVisible)
		{
		$.getJSON('functions/psAux.php', {}, function(data) {
				processDataFrompsAux(data);
			});
		}
	}

	function mpstatFunction()
	{
		$.getJSON('functions/mpstat.php', {}, function(data) {
				processDataFromMpStat(data);
			});
	}

	function processDataFromMpStat(data)
	{
		filterDataForMpStat(data);
	}

	function processDataFrompsAux(data)
	{
		filterDataForProcessesPreSort(data);
	}

	function poll()
	{
		mpstatFunction();
	}

	function slowPoll()
	{
		psAuxFunction();
	}

	poll();
	slowPoll();
	setInterval(poll, <?php echo $pollingRateOverviewMain; ?>);
	setInterval(slowPoll, <?php echo $pollingRateOverviewSlow; ?>);
	
	function resize()
	{
		var offsetHeight = 0;
		var offsetHeight2 = 0;
		if(document.getElementById('menu'))
		{
			offsetHeight = document.getElementById('menu').offsetHeight;
		}
		if(document.getElementById('topBarOverview'))
		{
			offsetHeight2 = document.getElementById('topBarOverview').offsetHeight;
			offsetHeight2 = offsetHeight2;
		}
		var heightOfMain = window.innerHeight - offsetHeight;
		var heightOfMainStyle = 'height:';
		heightOfMainStyle += heightOfMain;
		heightOfMainStyle += 'px';
		document.getElementById("main").setAttribute("style",heightOfMainStyle);
		document.getElementById("mainTable").setAttribute("style",heightOfMainStyle);
	}

	$(document).ready(function()
	{
		resize();
		window.onresize = resize;

	});

	</script>	
</body>