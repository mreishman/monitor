<form id="settingsMainVars" action="../core/php/settingsSave.php" method="post">
	<div class="settingsHeader">
		CPU Settings <button class="linkSmall" onclick="displayLoadingPopup();" >Save Changes</button>
	</div>
	<div class="settingsDiv" >
		<ul id="settingsUl">
			<li>
				<span class="settingsBuffer" > Sort processes by: </span>  
				<select name="defaultProcessorSort">
					<?php
					$count = 1;
					$sortProcOpt = array("User","PID","%CPU","%MEM","VSZ","RSS","TTY","STAT","START","TIME","Command");
					foreach ($sortProcOpt as $key): ?>
					<option <?php if(intval($defaultProcessorSort) === intval($count)){echo "selected";} ?> value=<?php echo $count;?> ><?php echo $key;?> ASC</option>
					<option <?php if(intval($defaultProcessorSort) === intval(-$count)){echo "selected";} ?> value=-<?php echo $count;?> ><?php echo $key;?> DESC</option>
					<?php 
					$count++;
					endforeach; ?>
					?>
				</select>
			</li>
		</ul>
	</div>
</form>