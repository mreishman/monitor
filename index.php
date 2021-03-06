<?php

function clean_url($url) {
    $parts = parse_url($url);
    return $parts['path'];
}

$baseRedirect = "";
$baseRedirectTwo = "";

$baseUrl = $baseRedirect."core/";
if(file_exists($baseRedirect.'local/layout.php'))
{
	$baseUrl = $baseRedirect."local/";
	//there is custom information, use this
	require_once($baseRedirect.'local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}
if(!file_exists($baseUrl.'conf/config.php'))
{
	$partOfUrl = clean_url($_SERVER['REQUEST_URI']);
	$url = "http://" . $_SERVER['HTTP_HOST'] .$partOfUrl ."setup/welcome.php";
	header('Location: ' . $url, true, 302);
	exit();
}
require_once($baseUrl.'conf/config.php'); 
require_once($baseRedirect.'core/conf/config.php');
require_once($baseRedirect.'core/php/configStatic.php');
require_once($baseRedirect.'core/php/commonFunctions.php');
require_once($baseRedirect.'core/php/loadVars.php');

if($pollingRateOverviewMainType === 'Seconds')
{
	$pollingRateOverviewMain *= 1000;
}
if($pollingRateOverviewSlowType === 'Seconds')
{
	$pollingRateOverviewSlow *= 1000;
}

$daysSince = calcuateDaysSince($configStatic['lastCheck']);
?>
<!doctype html>
<head>
	<title>Top | Overview</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>template/theme.css">
	<link rel="icon" type="image/png" href="<?php echo $baseRedirectTwo; ?>core/img/favicon.png" />
	<script src="<?php echo $baseRedirect; ?>core/js/jquery.js"></script>
	<style type="text/css">
		<?php if($fixedHeightForBlocks === "true"): ?>
			#topBarOverview{
			overflow-x: auto;
			height: 310px;
			white-space: nowrap;
		}
		<?php else: ?>
			#topBarOverview{
				overflow-x: auto;
				height: auto;
				white-space: normal;
			}
		<?php endif; ?>
	</style>
</head>
<body>

<?php require_once('header.php');?>	

	<div id="main">
		<div id="topBarOverview">
			<div onclick="showGraphPopup('cpuPopupCanvas','CPU','onePage')" style="cursor: pointer;" class="canvasMonitorDiv" >	
				<div class="canvasMonitorText canvasMonitorTextTop">CPU</div>
				<img id="canvasMonitorLoading_CPU" class="loadingSpinner" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				<canvas style="display: none;" class="canvasMonitor" id="cpuCanvas" width="200" height="200"></canvas>
					<div style="font-size: 88%;" class="canvasMonitorText canvasMonitorTextBottom">U <span id="canvasMonitorCPU_User">-</span>% | S <span id="canvasMonitorCPU_System">-</span>% | N <span id="canvasMonitorCPU_Other">-</span>%</div>
			</div>
			<div onclick="showGraphPopup('ramPopupCanvas','RAM','onePage')" style="cursor: pointer;" class="canvasMonitorDiv" >	
				<div class="canvasMonitorText canvasMonitorTextTop">RAM</div>
				<img id="canvasMonitorLoading_RAM" class="loadingSpinner" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				<canvas style="display: none;" class="canvasMonitor" id="ramCanvas" width="200" height="200"></canvas>
				<div class="canvasMonitorText canvasMonitorTextBottom">Used <span id="canvasMonitorRAM_Used">-</span>% | Cache <span id="canvasMonitorRAM_Cache">-</span>%</div>
			</div> 
			<div onclick="showGraphPopup('swapPopupCanvas','Swap','onePage')" style="cursor: pointer;"  class="canvasMonitorDiv" >	
				<div class="canvasMonitorText canvasMonitorTextTop">Swap</div>
				<img id="canvasMonitorLoading_Swap" class="loadingSpinner" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				<canvas style="display: none;" class="canvasMonitor" id="swapCanvas" width="200" height="200"></canvas>
				<div class="canvasMonitorText canvasMonitorTextBottom"><span id="canvasMonitorSwap">-</span>%</div>
			</div>
			<div class="canvasMonitorDiv" >	
				<div class="canvasMonitorText canvasMonitorTextTop">Disk Usage</div>
				<img id="canvasMonitorLoading_HDD" class="loadingSpinner" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				<div id="HDDCanvas" style="height: 200px; width: 200px; display: none; overflow: auto;" class="canvasMonitor" ></div>
				<div class="canvasMonitorText canvasMonitorTextBottom"><span style="color: white;">n/a</span></div>
			</div>
			<div class="canvasMonitorDiv" >	
				<div class="canvasMonitorText canvasMonitorTextTop">Disk IO</div>
				<img id="canvasMonitorLoading_DIO" class="loadingSpinner" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				<div id="DIOCanvas" style="height: 200px; width: 200px; display: none; overflow: auto;" class="canvasMonitor" ></div>
				<div class="canvasMonitorText canvasMonitorTextBottom"><span style="color: white;">n/a</span></div>
			</div>
			<div id="networkBlockIndexHeader" class="canvasMonitorDiv" >	
				<div class="canvasMonitorText canvasMonitorTextTop">Network</div>
				<img id="canvasMonitorLoading_NET" class="loadingSpinner" src='<?php echo $baseRedirectTwo; ?>core/img/loading.gif' height='50' width='50'> 
				<div id="NETCanvas" style="height: 200px; width: 200px; display: none;" class="canvasMonitor" ></div>
				<div class="canvasMonitorText canvasMonitorTextBottom"><span style="color: white;">n/a</span></div>
			</div>

		</div>
		<div id="bottomBarOverview">
			<div class="bottomBarOverviewHalf bottomBarOverviewLeft" id="processIds">

			</div>
			<div class="bottomBarOverviewHalf bottomBarOverviewRight" id="networkArea">

			</div>
		</div>
	</div>
	<script type="text/javascript">
		var baseRedirect = "";
	</script>
	<?php readfile($baseRedirect.'core/html/popup.html') ?>	
	<script src="<?php echo $baseRedirect; ?>core/js/top.js"></script>
	<script type="text/javascript">
		<?php
		echo "var autoCheckUpdate = ".$autoCheckUpdate.";";
		echo "var dateOfLastUpdate = '".$configStatic['lastCheck']."';";
		echo "var daysSinceLastCheck = '".$daysSince."';";
		echo "var daysSetToUpdate = '".$autoCheckDaysUpdate."';";
		echo "var ignoreLoopDisks = '".$ignoreLoopDisks."';";
		echo "var ignoreLoopNetwork = '".$ignoreLoopNetwork."';";
		?>
	var dontNotifyVersion = "<?php echo $dontNotifyVersion;?>";
	var currentVersion = "<?php echo $configStatic['version'];?>";
	var numberOfColumns = 40;
	var defaultArray = new Array();
	for (var i = 0; i < numberOfColumns; i++) 
	{
		defaultArray.push(0);
	}
	var dataSwap = false;
	var nullReturnForDefaultPoll = false;
	var cpuInfoArray_User = [];
	var cpuInfoArray_heightVar = [];
	var cpuInfoArray_other = [];
	var cpuInfoArray_System = [];
	var ramInfoArray_Used = [];
	var ramInfoArray_Cache = [];
	var ramInfoArray_heightVar = [];
	var swapInfoArray_Used = [];
	var swapInfoArray_heightVar = [];
	var networkArrayOfArrays = [];
	var networkArrayOfArraysDifference = [];
	var processInfoArray = [];
	var processInfoArrayDiff = [];
	var ioDiff = [];
	var ioDiffHistory = [];
	var phpUserTimeDiff = [];
	var phpSystemTimeDiff = [];
	var phpUserTimeHistory = [];
	var phpSystemTimeHistory = [];
	var processFilterByRow = <?php echo $defaultProcessorSort;?>;
	var selectedUser = "USER";
	var baseForSystemTime = 0;
	var heightForPopup = 0;
	var widthForPopup = 0;
	var ioStatNotInstalled = false;
	for (var i = defaultArray.length - 1; i >= 0; i--) {
		cpuInfoArray_User.push(defaultArray[i]);
		cpuInfoArray_heightVar.push(defaultArray[i]);
		cpuInfoArray_other.push(defaultArray[i]);
		cpuInfoArray_System.push(defaultArray[i]);
		ramInfoArray_Used.push(defaultArray[i]);
		ramInfoArray_Cache.push(defaultArray[i]);
		ramInfoArray_heightVar.push(defaultArray[i]);
		swapInfoArray_Used.push(defaultArray[i]);
		swapInfoArray_heightVar.push(defaultArray[i]);
		phpUserTimeHistory.push(defaultArray[i]);
		phpSystemTimeHistory.push(defaultArray[i]);
	}

	var cpuArea = document.getElementById('cpuCanvas');
	var cpuAreaContext = cpuArea.getContext("2d");

	var ramArea = document.getElementById('ramCanvas');
	var ramAreaContext = ramArea.getContext("2d");

	var swapArea = document.getElementById('swapCanvas');
	var swapAreaContext = swapArea.getContext("2d");

	var numberOfCores = 0;

	function psAuxFunction()
	{
		if(!dropdownMenuVisible)
		{
		$.getJSON('functions/psAux.php', {}, function(data) {
				processDataFrompsAux(data);
			});
		}
	}

	function procNetDev()
	{
		$.getJSON('functions/procNetDev.php', {}, function(data) {
				processDataFromprocNetDev(data);
			});
	}

	function procStatFunc()
	{
		$.getJSON('functions/procStat.php', {}, function(data) {
				processDataFromprocStat(data);
			});
	}

	function procFree()
	{
		$.getJSON('functions/free.php', {}, function(data) {
				processDataFromFree(data);
			});
	}

	function procDiskstatsFunc()
	{
		$.getJSON('functions/diskstats.php', {}, function(data) {
			processDataFromDiskStats(data);
		});
	}

	function dfALFunction()
	{
		$.getJSON('functions/dfAL.php', {}, function(data) {
				processDataFrompsdfAL(data);
			});
	}

	function processDataFromprocStat(data)
	{
		filterDataFromProcStat(data);
	}

	function processDataFromFree(data)
	{
		filterDataForFreeRam(data);
		filterDataForFreeSwap(data);
	}

	function processDataFromDiskStats(data)
	{
		filterDataForioStatDx(data);
	}

	function processDataFromprocNetDev(data)
	{
		filterDataForNetworkDev(data);
	}

	function processDataFrompsAux(data)
	{
		filterDataForProcessesPreSort(data);
	}

	function processDataFrompsdfAL(data)
	{
		filterDataForDiskSpace(data);
	}

	function poll()
	{
		procFree();
		procStatFunc();
		procNetDev();
		procDiskstatsFunc();
	}

	function slowPoll()
	{
		dfALFunction();
		psAuxFunction();
	}

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
		heightOfMain = window.innerHeight - offsetHeight - offsetHeight2;
		heightOfMainStyle = 'height:';
		heightOfMainStyle += heightOfMain;
		heightOfMainStyle += 'px';
		document.getElementById("processIds").setAttribute("style",heightOfMainStyle);
		document.getElementById("networkArea").setAttribute("style",heightOfMainStyle);
	}

	$(document).ready(function()
	{
		resize();
		window.onresize = resize;

		poll();
		slowPoll();
		setInterval(poll, <?php echo $pollingRateOverviewMain; ?>);
		setInterval(slowPoll, <?php echo $pollingRateOverviewSlow; ?>);

		checkForUpdateMaybe();
	});

	</script>
</body>
<form id="settingsInstallUpdate" action="update/updater.php" method="post" style="display: none"></form>