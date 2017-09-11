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
	<title>Top | Overview</title>
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
		
	</div>
	<script type="text/javascript">
		var baseRedirect = "";
		<?php if($monitorStatus['withLogHog'] == 'true'): ?>
			baseRedirect = "../";
		<?php endif; ?>
	</script>
	<?php readfile($baseRedirect.'core/html/popup.html') ?>	
</body>