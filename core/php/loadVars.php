<?php

require_once('verifyWriteStatus.php');
checkForUpdate($_SERVER['REQUEST_URI']);

//check for previous update, if failed

$varToIndexDir = "";
$countOfSlash = 0;
while($countOfSlash < 20 && !file_exists($varToIndexDir."error.php"))
{
  $varToIndexDir .= "../";        
}

$baseUrl = $varToIndexDir."core/";
if(file_exists($varToIndexDir.'local/layout.php'))
{
  $baseUrl = $varToIndexDir."local/";
  //there is custom information, use this
  require_once($varToIndexDir.'local/layout.php');
  $baseUrl .= $currentSelectedTheme."/";
}
$boolForUpgrade = true;
if(file_exists($baseUrl.'conf/config.php'))
{
	require_once($baseUrl.'conf/config.php'); 
}
else
{
	$config = array();
	$boolForUpgrade = false;
}
require_once($varToIndexDir.'core/conf/config.php');

$URI = $_SERVER['REQUEST_URI'];
$layoutVersion = 0;
$configVersion = 0;
if($boolForUpgrade && (strpos($URI, 'upgradeLayout') === false) && (strpos($URI, 'upgradeConfig') === false) && (strpos($URI, 'core/php/template/upgrade') === false))
{
	//check if upgrade script is needed
	
	if(isset($config['layoutVersion']))
	{
		$layoutVersion = $config['layoutVersion'];
	}
	if($layoutVersion !== $defaultConfig['layoutVersion'])
	{
		//redirect to upgrade script for layoutVersion page
		header("Location: ".$varToIndexDir."core/php/template/upgradeLayout.php");
		exit();
	}

	if(isset($config['configVersion']))
	{
		$configVersion = $config['configVersion'];
	}
	if($configVersion !== $defaultConfig['configVersion'])
	{
		//redirect to upgrade script for config page
		header("Location: ".$varToIndexDir."core/php/template/upgradeConfig.php");
		exit();
	}
}

if(isset($_POST['autoCheckUpdate']))
{
	$autoCheckUpdate = $_POST['autoCheckUpdate'];
}
elseif(array_key_exists('autoCheckUpdate', $config))
{
	$autoCheckUpdate = $config['autoCheckUpdate'];
}
else
{
	$autoCheckUpdate = $defaultConfig['autoCheckUpdate'];
}
if(isset($_POST['developmentTabEnabled']))
{
	$developmentTabEnabled = $_POST['developmentTabEnabled'];
}
elseif(array_key_exists('developmentTabEnabled', $config))
{
	$developmentTabEnabled = $config['developmentTabEnabled'];
}
else
{
	$developmentTabEnabled = $defaultConfig['developmentTabEnabled'];
}
if(isset($_POST['enableDevBranchDownload']))
{
	$enableDevBranchDownload = $_POST['enableDevBranchDownload'];
}
elseif(array_key_exists('enableDevBranchDownload', $config))
{
	$enableDevBranchDownload = $config['enableDevBranchDownload'];
}
else
{
	$enableDevBranchDownload = $defaultConfig['enableDevBranchDownload'];
}
if(isset($_POST['popupSettings']))
{
	$popupSettings = $_POST['popupSettings'];
}
elseif(array_key_exists('popupSettings', $config))
{
	$popupSettings = $config['popupSettings'];
}
else
{
	$popupSettings = $defaultConfig['popupSettings'];
}

if(array_key_exists('popupSettingsCustom', $config))
{
	$popupSettingsCustom = $config['popupSettingsCustom'];
}
else
{
	$popupSettingsCustom = $defaultConfig['popupSettingsCustom'];
}
if(isset($_POST['autoCheckDaysUpdate']))
{
	$autoCheckDaysUpdate = $_POST['autoCheckDaysUpdate'];
}
elseif(array_key_exists('autoCheckDaysUpdate', $config))
{
	$autoCheckDaysUpdate = $config['autoCheckDaysUpdate'];
}
else
{
	$autoCheckDaysUpdate = $defaultConfig['autoCheckDaysUpdate'];
}
if(isset($_POST['baseUrlUpdate']))
{
	$baseUrlUpdate = $_POST['baseUrlUpdate'];
}
elseif(array_key_exists('baseUrlUpdate', $config))
{
	$baseUrlUpdate = $config['baseUrlUpdate'];
}
else
{
	$baseUrlUpdate = $defaultConfig['baseUrlUpdate'];
}
if(isset($_POST['dontNotifyVersion']))
{
	$dontNotifyVersion = $_POST['dontNotifyVersion'];
}
elseif(array_key_exists('dontNotifyVersion', $config))
{
	$dontNotifyVersion = $config['dontNotifyVersion'];
}
else
{
	$dontNotifyVersion = $defaultConfig['dontNotifyVersion'];
}
if(isset($_POST['updateNoticeMeter']))
{
	$updateNoticeMeter = $_POST['updateNoticeMeter'];
}
elseif(array_key_exists('updateNoticeMeter', $config))
{
	$updateNoticeMeter = $config['updateNoticeMeter'];
}
else
{
	$updateNoticeMeter = $defaultConfig['updateNoticeMeter'];
}
if(isset($_POST['pollingRateOverviewMain']))
{
	$pollingRateOverviewMain = $_POST['pollingRateOverviewMain'];
}
elseif(array_key_exists('pollingRateOverviewMain', $config))
{
	$pollingRateOverviewMain = $config['pollingRateOverviewMain'];
}
else
{
	$pollingRateOverviewMain = $defaultConfig['pollingRateOverviewMain'];
}
if(isset($_POST['pollingRateOverviewMainType']))
{
	$pollingRateOverviewMainType = $_POST['pollingRateOverviewMainType'];
}
elseif(array_key_exists('pollingRateOverviewMainType', $config))
{
	$pollingRateOverviewMainType = $config['pollingRateOverviewMainType'];
}
else
{
	$pollingRateOverviewMainType = $defaultConfig['pollingRateOverviewMainType'];
}
if(isset($_POST['pollingRateOverviewSlow']))
{
	$pollingRateOverviewSlow = $_POST['pollingRateOverviewSlow'];
}
elseif(array_key_exists('pollingRateOverviewSlow', $config))
{
	$pollingRateOverviewSlow = $config['pollingRateOverviewSlow'];
}
else
{
	$pollingRateOverviewSlow = $defaultConfig['pollingRateOverviewSlow'];
}
if(isset($_POST['pollingRateOverviewSlowType']))
{
	$pollingRateOverviewSlowType = $_POST['pollingRateOverviewSlowType'];
}
elseif(array_key_exists('pollingRateOverviewSlowType', $config))
{
	$pollingRateOverviewSlowType = $config['pollingRateOverviewSlowType'];
}
else
{
	$pollingRateOverviewSlowType = $defaultConfig['pollingRateOverviewSlowType'];
}


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$popupSettingsArraySave = "";
	if($popupSettings == "all")
	{
		$popupSettingsArraySave = "
			'saveSettings'	=>	'true',
			'versionCheck'	=> 'true'
			";
	}
	elseif($popupSettings == "none")
	{
		$popupSettingsArraySave = "
			'saveSettings'	=>	'false',
			'versionCheck'	=> 'false'
			";
	}
	else
	{
		if(isset($_POST['saveSettings']))
		{
			$popupSettingsArraySave = "
			'saveSettings'	=>	'".$_POST['saveSettings']."',
			'versionCheck'	=> '".$_POST['versionCheck']."'
			";
		}
		else
		{
			$popupSettingsArraySave = "";
			$count = 0;
			foreach ($popupSettingsCustom as $key => $value)
			{
				$popupSettingsArraySave .= "'".$key."'	=>	'".$value."'";
				$count++;
				if($count != 2)
				{
					$popupSettingsArraySave .= ",";
				}
			}
		}
	}
	$popupSettingsCustom = $popupSettingsArraySave;
}
?>