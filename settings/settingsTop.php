<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0">
<meta http-equiv="expires" content="Sat, 31 Oct 2014 00:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">

<?php
$baseUrl = "../core/";
if(file_exists('../local/layout.php'))
{
	$baseUrl = "../local/";
	//there is custom information, use this
	require_once('../local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}
require_once($baseUrl.'conf/config.php'); 
require_once('../core/conf/config.php');
require_once('../core/php/configStatic.php');
require_once('../core/php/loadVars.php');
require_once('../core/php/updateCheck.php');
?>
<!doctype html>
<head>
	<title>Settings | Top</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>template/theme.css">
	<link rel="icon" type="image/png" href="../core/img/favicon.png" />
	<script src="../core/js/jquery.js"></script>
</head>
<body>

<?php require_once('header.php');?>	
	<div id="main">	
		<?php require_once('../core/php/template/settingsTopMain.php'); ?>
		<?php require_once('../core/php/template/settingsTop.php'); ?>
		<?php require_once('../core/php/template/settingsCpu.php'); ?>
		<?php require_once('../core/php/template/settingsDiskIO.php'); ?>
		<?php require_once('../core/php/template/settingsNetwork.php'); ?>
	</div>
	<?php readfile('../core/html/popup.html') ?>	
</body>
<script src="../core/js/settings.js"></script>
<script type="text/javascript">

document.getElementById("popupSelect").addEventListener("change", showOrHidePopupSubWindow, false);
document.getElementById("settingsSelect").addEventListener("change", showOrHideUpdateSubWindow, false);

function goToUrl(url)
	{
		if(true)
		{
			window.location.href = url;
		}
		else
		{
			displaySavePromptPopup(url);
		}
	}

function showOrHidePopupSubWindow()
{
	var valueForPopup = document.getElementById('popupSelect').value;
	if(valueForPopup == 'custom')
	{
		document.getElementById('settingsPopupVars').style.display = 'block';
	}
	else
	{
		document.getElementById('settingsPopupVars').style.display = 'none';
	}
}
function showOrHideUpdateSubWindow()
{
	var valueForPopup = document.getElementById('settingsSelect').value;
	if(valueForPopup == 'true')
	{
		document.getElementById('settingsAutoCheckVars').style.display = 'block';
	}
	else
	{
		document.getElementById('settingsAutoCheckVars').style.display = 'none';
	}
}
</script>