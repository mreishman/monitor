<form id="settingsMainVars" action="../core/php/settingsSave.php" method="post">
	<div class="settingsHeader">
		Network Settings <button class="linkSmall" onclick="displayLoadingPopup();" >Save Changes</button>
	</div>
	<div class="settingsDiv" >
		<ul id="settingsUl">
			<li>
				<span class="settingsBuffer" > Ignore Lo Address: </span>  
				<select id="settingsSelect" name="ignoreLoopNetwork">
						<option <?php if($ignoreLoopNetwork == 'true'){echo "selected";} ?> value="true">True</option>
						<option <?php if($ignoreLoopNetwork == 'false'){echo "selected";} ?> value="false">False</option>
				</select>
			</li>
		</ul>
	</div>
</form>