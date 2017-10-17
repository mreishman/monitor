<form id="settingsMainVars" action="../core/php/settingsSaveTop.php" method="post">
		<div class="settingsHeader">
			Top Settings <button class="linkSmall" onclick="displayLoadingPopup();" >Save Changes</button>
		</div>
		<div class="settingsDiv" >
			<ul id="settingsUl">
				<li>
					<span class="settingsBuffer" > Poll Rate Main: </span>  <input type="text" name="pollingRateOverviewMain" value="<?php echo $pollingRateOverviewMain;?>" >
					<select name="pollingRateOverviewMainType">
							<option <?php if($pollingRateOverviewMainType == 'Milliseconds'){echo "selected";} ?> value="Milliseconds">Milliseconds</option>
							<option <?php if($pollingRateOverviewMainType == 'Seconds'){echo "selected";} ?> value="Seconds">Seconds</option>
					</select>
				</li>
				<li>
					<span class="settingsBuffer" > Poll Rate Slow: </span>  <input type="text" name="pollingRateOverviewSlow" value="<?php echo $pollingRateOverviewSlow;?>" >
					<select name="pollingRateOverviewSlowType">
							<option <?php if($pollingRateOverviewSlowType == 'Milliseconds'){echo "selected";} ?> value="Milliseconds">Milliseconds</option>
							<option <?php if($pollingRateOverviewSlowType == 'Seconds'){echo "selected";} ?> value="Seconds">Seconds</option>
					</select>
				</li>
				<li>
					<span class="settingsBuffer" > Sort processes by: </span>  
					<select name="defaultProcessorSort">
							<option <?php if($defaultProcessorSort === 1){echo "selected";} ?> value=1>User ASC</option>
							<option <?php if($defaultProcessorSort === -1){echo "selected";} ?> value=-1>User DESC</option>
							<option <?php if($defaultProcessorSort === 2){echo "selected";} ?> value=1>PID ASC</option>
							<option <?php if($defaultProcessorSort === -2){echo "selected";} ?> value=-1>PID DESC</option>
							<option <?php if($defaultProcessorSort === 3){echo "selected";} ?> value=1>%CPU ASC</option>
							<option <?php if($defaultProcessorSort === -3){echo "selected";} ?> value=-1>%CPU DESC</option>
							<option <?php if($defaultProcessorSort === 4){echo "selected";} ?> value=1>%MEM ASC</option>
							<option <?php if($defaultProcessorSort === -4){echo "selected";} ?> value=-1>%MEM DESC</option>
							<option <?php if($defaultProcessorSort === 5){echo "selected";} ?> value=1>VSZ ASC</option>
							<option <?php if($defaultProcessorSort === -5){echo "selected";} ?> value=-1>VSZ DESC</option>
							<option <?php if($defaultProcessorSort === 6){echo "selected";} ?> value=1>RSS ASC</option>
							<option <?php if($defaultProcessorSort === -6){echo "selected";} ?> value=-1>RSS DESC</option>
							<option <?php if($defaultProcessorSort === 7){echo "selected";} ?> value=1>TTY ASC</option>
							<option <?php if($defaultProcessorSort === -7){echo "selected";} ?> value=-1>TTY DESC</option>
							<option <?php if($defaultProcessorSort === 8){echo "selected";} ?> value=1>STAT ASC</option>
							<option <?php if($defaultProcessorSort === -8){echo "selected";} ?> value=-1>STAT DESC</option>
							<option <?php if($defaultProcessorSort === 9){echo "selected";} ?> value=1>START ASC</option>
							<option <?php if($defaultProcessorSort === -9){echo "selected";} ?> value=-1>START DESC</option>
							<option <?php if($defaultProcessorSort === 10){echo "selected";} ?> value=1>TIME ASC</option>
							<option <?php if($defaultProcessorSort === -10){echo "selected";} ?> value=-1>TIME DESC</option>
							<option <?php if($defaultProcessorSort === 11){echo "selected";} ?> value=1>Command ASC</option>
							<option <?php if($defaultProcessorSort === -11){echo "selected";} ?> value=-1>Command DESC</option>
					</select>
				</li>
				
			</ul>
		</div>
	</form>