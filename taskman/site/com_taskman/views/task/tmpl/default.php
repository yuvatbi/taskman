<?php 

defined('_JEXEC') or die('Restricted Access');

?>


<script type="text/javascript">
	function saveDate(cal) {
		var data = {
			task_id: <?php echo $this->item->task_id; ?>,
			duedate: $(cal).value,
			};
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::base();?>index.php?option=com_taskman&view=task&task=task.saveDate",
			data: data,
			success: function(response)
			{
				jQuery("#duedate_result").html(response);
			}
		});
		return false;
	}


	function saveProject() {
		var data = {
			task_id: <?php echo $this->item->task_id; ?>,
			projectname: document.getElementById('valtext').value,
			};
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::base();?>index.php?option=com_taskman&view=task&task=task.saveProject",
			data: data,
			success: function(response)
			{
				jQuery("#distext").html(response);
				document.getElementById('protext').style.display = 'none';
			}
		});
		return false;
	}


	function saveTags() {
		var data = {
			task_id: <?php echo $this->item->task_id; ?>,
			tagname: document.getElementById('valtags').value,
			};
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::base();?>index.php?option=com_taskman&view=task&task=task.saveTags",
			data: data,
			success: function(response)
			{
				jQuery("#distag").html(response);
				document.getElementById('tagsshow').style.display = 'none';
			}
		});
		return false;
	}
	

	function changedata(val)
	{
		if(val == 1)
		{
			document.getElementById('protext').style.display = 'block';
			document.getElementById('protexthide').style.display = 'none';
		}
		else if(val=2)
		{
			document.getElementById('tagsshow').style.display = 'block';
			document.getElementById('tagshide').style.display = 'none';
		}
	}

	
</script>

<style type="text/css">
#protext,#tagsshow {
	display: none;
	padding-bottom: 10px;
}

#distext,#distag {
	text-decoration: bold;
}
</style>


<div class="row-fluid">
	<div class="span6 row-stripped">
		<div class="well ">


			<div class="row-fluid ">
				<div class="span12">

					<div class="span8 muted">
						<h2>
							<?php echo $this->item->title; ?>
						</h2>
					</div>
					<div class="span5">
						<strong></strong>

					</div>

				</div>

			</div>

			<div class="row-fluid">
				<div class="span12">

					<div class="span3 muted">
						<?php echo JText::_('COM_TASKMAN_TASKMAN_NOTES_LABEL');?>
					</div>
					<div class="span8">
						<strong><?php 	echo $this->item->notes; ?> </strong>
						<hr>
					</div>

				</div>
			</div>


			<div class="row-fluid">
				<div class="span12">
					<div class="span5 muted">
						<i class="icon-user"></i>
						<?php echo JText::_('COM_TASKMAN_TASKMAN_ASSIGNEE_LABEL');?>

					</div>
					<div class="span7">
						<strong><?php echo $this->item->asignee; ?> </strong>
					</div>

				</div>
			</div>


			<div class="row-fluid">
				<div class="span12">


					<div class="span5 muted" id="projectid" onclick="changedata(1)">
						<?php echo JText::_('COM_TASKMAN_TASKMAN_PROJECTS_LABEL');?>
					</div>
					<div class="span7">
						<div id="distext"></div>
						<div id="protexthide">
							<strong><?php 	echo $this->item->projects; ?> </strong>
						</div>
						<div id="protext">
							<input type="text" id="valtext" name="protext"
								class="input-medium"
								value="<?php 	echo $this->item->projects; ?>" />
							<button name="but" onclick="saveProject()">Submit</button>
						</div>

					</div>

				</div>
			</div>



			<div class="row-fluid">
				<div class="span12">

					<div class="span5 muted">
						<i class="icon-calendar"></i>
						<?php echo JText::_('COM_TASKMAN_TASKMAN_DUEDATE_LABEL');?>

					</div>
					<div class="span3">
						<b id="duedate_result"><?php echo $this->item->duedate; ?> </b>
					</div>
					<div class="span3">
						<?php 
						$attribs = Array(
								'onchange' => 'saveDate(this)',
								'style'=>'display:none;'
						);
							echo JHtml::calendar($this->item->duedate, 'duedate', 'duedate','%Y-%m-%d',$attribs );  ?>


					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">


						<div class="span5 muted" id="projectid" onclick="changedata(2)">
							<i class="icon-search"></i>
							<?php echo JText::_('COM_TASKMAN_TASKMAN_TAGS_LABEL');?>

						</div>
						<div class="span7">

							<div id="distag"></div>
							<div id="tagshide">
								<strong><?php echo $this->item->tags; ?> </strong>
							</div>
							<div id="tagsshow">
								<input type="text" id="valtags" name="tagstext"
									class="input-medium" value="<?php 	echo $this->item->tags; ?>" />
								<button name="but2" onclick="saveTags()">Submit</button>
							</div>
						</div>


					</div>
				</div>


				<div class="row-fluid">
					<div class="span12">

						<div class="span5 muted">
							<?php echo JText::_('COM_TASKMAN_TASKMAN_FOLLOWERS_LABEL');?>
						</div>
						<div class="span7">
							<strong><?php echo $this->item->followers; ?> </strong>

						</div>


					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="span5 muted">
							<?php echo JText::_('COM_TASKMAN_TASKMAN_ACTIVITY_FEED_LABEL');?>
						</div>
						<div class="span7">
							<strong><?php echo $this->item->feed; ?> </strong>

						</div>

					</div>
				</div>
				
				
				<div class="row-fluid">
					<div class="span12 muted">
						
							<strong><?php echo $this->item->comments; ?> </strong>

						

					</div>
				</div>
				

			</div>

		</div>


	</div>

</div>
