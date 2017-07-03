<?php

$baseUrl = "../../core/";
if(file_exists('../../local/layout.php'))
{
	$baseUrl = "../../local/";
	//there is custom information, use this
	require_once('../../local/layout.php');
	$baseUrl .= $currentSelectedTheme."/";
}

if(file_exists($baseUrl.'conf/config.php'))
{
	require_once($baseUrl.'conf/config.php'); 
}
else
{
	$config = array();
}
require_once('../../core/conf/config.php'); 
require_once('loadVars.php');


	$fileName = ''.$baseUrl.'conf/config.php';

	//Don't forget to update Ajax version

	$newInfoForConfig = "
	<?php
		$"."config = array(
			'pollingRateOverviewMain' => '".$pollingRateOverviewMain."',
			'pollingRateOverviewSlow' => '".$pollingRateOverviewSlow."',
			'autoCheckUpdate' => '".$autoCheckUpdate."',
			'autoCheckDaysUpdate'	=>	'".$autoCheckDaysUpdate."',
			'developmentTabEnabled' => '".$developmentTabEnabled."',
			'enableDevBranchDownload' => '".$enableDevBranchDownload."',
			'popupSettings'	=>	'".$popupWarnings."',
			'pollingRateOverviewMainType'	=> '".$pollingRateOverviewMainType."',
			'pollingRateOverviewSlowType'	=> '".$pollingRateOverviewSlowType."',
			'baseUrlUpdate'	=> '".$baseUrlUpdate."',
			'dontNotifyVersion'	=> '".$dontNotifyVersion."',
			'updateNoticeMeter'	=> '".$updateNoticeMeter."'
		);
	?>";

	file_put_contents($fileName, $newInfoForConfig);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
?>