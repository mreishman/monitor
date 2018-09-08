<form id="settingsMainVars" action="../core/php/settingsSave.php" method="post">
	<div class="settingsHeader">
		Disk IO Settings <button class="linkSmall" onclick="displayLoadingPopup();" >Save Changes</button>
	</div>
	<div class="settingsDiv" >
		<ul id="settingsUl">
			<li>
				<span class="settingsBuffer" > Ignore Loop Disks: </span>  
				<select id="settingsSelect" name="ignoreLoopDisks">
						<option <?php if($ignoreLoopDisks == 'true'){echo "selected";} ?> value="true">True</option>
						<option <?php if($ignoreLoopDisks == 'false'){echo "selected";} ?> value="false">False</option>
				</select>
			</li>
		</ul>
	</div>
</form>