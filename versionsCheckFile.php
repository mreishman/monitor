<?php

$versionCheckArray = array(
	'version'		=> '1.1.5',
	'versionList'		=> array(
		'1.1'	        => array(
			'branchName'	=> '1.1Update',
			'releaseNotes'	=> '<ul><li>Features<ul><li>Added CPU page</li><li>Added settings option to set default sort for processes</li><li>Added delay to some of the differential status checks</li></ul></li><li>Bug Fixes<ul><li>Fixed issue with resizing the window while on index page</li></ul></li></ul>'
		),
		'1.1.1'	        => array(
			'branchName'	=> '1.1.1Update',
			'releaseNotes'	=> '<ul><li>Bug Fixes<ul><li>Fixed bug with sorting by some options</li><li>Fixed issue with auto check update</li><li>Fixed issue with favicon</li></ul></li></ul>'
		),
		'1.1.2'	        => array(
			'branchName'	=> '1.1.2Update',
			'releaseNotes'	=> '<ul><li>Bug Fixes<ul><li>Fixed home page issues with updater</li></ul></li></ul>'
		),
		'1.1.3'	        => array(
			'branchName'	=> '1.1.3Update',
			'releaseNotes'	=> '<ul><li>Bug Fixes<ul><li>Selenium monitor link</li><li>Updater patch</li></ul></li></ul>'
		),
		'1.1.4'	        => array(
			'branchName'	=> '1.1.4Update',
			'releaseNotes'	=> '<ul><li>Bug Fixes<ul><li>Fix for ioStat message if not installed</li><li>Fix for mpstat message if not installed</li></ul></li></ul>'
		),
		'1.1.5'	        => array(
			'branchName'	=> '1.1.5Update',
			'releaseNotes'	=> '<ul><li>Bug Fixes<ul><li>Style fix for low res monitors (one column)</li><li>Switched from ioStat to just reading /proc/diskstats for better compatability</li><li>Better style for scrollbars</li><li>Changed base poll request to be 1.5s from 1s (has to be greater than 1 or will start adding delays between requests)</li></ul></li></ul>'
		),
	)
);
?>
