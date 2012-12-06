<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// load tooltip behavior
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
jimport( 'joomla.html.html.jgrid' );

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

//$sortFields = $this->getSortFields();

?>



<script type="text/javascript">
	

	

	function zoomout(data)
	{					
		
		for(i=1; i<=10;i++)
		{
				if(data != i)
				{
					document.getElementById('task_content'+i).style.display = 'none';
				}

				if(data == i)
				{
					document.getElementById('task_content'+data).style.display = 'block';
				}

		}	
		
		
	}



	function saveDate(cal,id) {
		var data = {
			task_id: id,
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

	

	function saveProject(id) {
		var data = {
			task_id: id,
			projectname: document.getElementById('valtext'+id).value,
			};
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::base();?>index.php?option=com_taskman&view=task&task=task.saveProject",
			data: data,
			success: function(response)
			{
				jQuery("#distext"+id).html(response);
				document.getElementById('protext'+id).style.display = 'none';
			}
		});
		return false;
	}


	function markComplete(id) {

		document.getElementById('task_content'+id).style.display = 'none';
		document.getElementById('rowdis'+id).style.backgroundColor ='lightgreen'
	}
	

	

	function saveTags(id) {
		var data = {
			task_id: id,
			tagname: document.getElementById('valtags'+id).value,
			};
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::base();?>index.php?option=com_taskman&view=task&task=task.saveTags",
			data: data,
			success: function(response)
			{
				jQuery("#distag"+id).html(response);
				document.getElementById('tagsshow'+id).style.display = 'none';
			}
		});
		return false;
	}



	function changedata(val,id)
	{
		if(val == 1)
		{
			document.getElementById('protext'+id).style.display = 'block';
			document.getElementById('protexthide'+id).style.display = 'none';
		}
		else if(val == 2)
		{
				alert(val);
			document.getElementById('tagsshow'+id).style.display = 'block';
			document.getElementById('tagshide'+id).style.display = 'none';
		}
	}
	
	Joomla.orderTable = function() {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}


	
</script>

<style type="text/css">
#protext,#tagsshow , <?php foreach($this->items as $i => $item): $canChange=1;
							$id = $item->task_id;
							$yy =0;
							foreach($this->items as $i => $item): $canChange=1;
							$yy = $yy+1;
							endforeach;
							echo "#task_content".$id;

								if($id != $yy)
									echo ",";
							
							
				
					 endforeach; ?> {
	display: none;
	padding-bottom: 10px;
}



<?php foreach($this->items as $i => $item): $canChange=1;
							$id = $item->task_id;
							$yy =0;
							foreach($this->items as $i => $item): $canChange=1;
							$yy = $yy+1;
							endforeach;
							echo "#protext".$id;

								if($id != $yy)
									echo ",";
							
							
				
					 endforeach; ?> {
	display: none;
	padding-bottom: 10px;
}
					 
	
	
	<?php foreach($this->items as $i => $item): $canChange=1;
							$id = $item->task_id;
							$yy =0;
							foreach($this->items as $i => $item): $canChange=1;
							$yy = $yy+1;
							endforeach;
							echo "#tagsshow".$id;

								if($id != $yy)
									echo ",";
							
							
				
					 endforeach; ?> {
	display: none;
	padding-bottom: 10px;
}				 

#distext,#distag {
	text-decoration: bold;
}


</style>




<form
	action="<?php echo JRoute::_('index.php?option=com_taskman&view=tasks'); ?>"
	method="post" name="adminForm" id="adminForm">
	<?php if(!empty( $this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif;?>

			

			<div class="span6">
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="20">
								<!-- arg1-text, arg2-db query name, arg3,4 ordering default values -->
								<?php echo JHtml::_('grid.sort', 'TASKMAN_TASKS_ID', 'task_id', $listDirn, $listOrder); ?>
							</th>
							<th width="10"><input type="checkbox" name="toggle" value=""
								onclick="Joomla.checkAll(this)" />
							</th>


							<th><?php echo JHtml::_('grid.sort', 'TASKMAN_TASKS_PUBLISHED', 'published', $listDirn, $listOrder); ?>
							</th>


							<th><?php echo JHtml::_('grid.sort', 'TASKMAN_TASKS_TITLE', 'title', $listDirn, $listOrder); ?>
							</th>

						</tr>

					</thead>
					<tfoot>
						<tr>
							<td colspan="3"><?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>

					</tfoot>
					<tbody>



						<?php foreach($this->items as $i => $item): 

						$canChange=1;

						?>
						
						<tr class="row<?php echo $i % 2; ?>" id="rowdis<?php echo $item->task_id; ?>"  >
							<td><?php echo $item->task_id; ?>
							</td>
							<td><?php echo JHtml::_('grid.id', $i, $item->task_id); ?>
							</td>


							<td>
							<?php echo JHtml::_('jgrid.published', $item->state, $i, 'tasks.', $canChange, 'cb'); ?>
							</td>
							<td><?php echo $item->title; ?>
							</td>

							<td><i class="icon-arrow-right btn"
								onClick="zoomout(<?php echo $item->task_id; ?>)"></i>
							</td>

						</tr>
						
						<?php endforeach; ?>

					</tbody>
				</table>

				<div>
					<input type="hidden" name="task" value="" /> <input type="hidden"
						name="boxchecked" value="0" /> <input type="hidden"
						name="filter_order" value="<?php echo $listOrder; ?>" /> <input
						type="hidden" name="filter_order_Dir"
						value="<?php echo $listDirn; ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</div>
			</div>







			<?php foreach($this->items as $i => $item): 

			$canChange=1;

			?>

			<div class="span6 row-stripped" id="task_content<?php echo $item->task_id; ?>">
				<input type="hidden" name="taskid" id="taskid" value="<?php echo $item->task_id; ?>" />
				<div class="row-fluid">

					<div class="well ">

					
					
					

						<div class="row-fluid ">
							<div class="span12">
							<div class="span1 pull-right"  onclick="markComplete(<?php echo $item->task_id; ?>)">
										<i class="icon-ok btn" ></i>
								</div>
							<div class="span3 pull-right" >
										Mark Complete
								</div>
								
								<div class="span8 muted">
									<h2>
										<?php echo $item->title; ?>
									</h2>
								</div>
								

							</div>

						</div>

						<div class="row-fluid">
							<div class="span12">

								<div class="span3 muted">
									<?php echo JText::_('COM_TASKMAN_TASKMAN_NOTES_LABEL');?>
								</div>
								<div class="span8">
									<strong><?php 	echo $item->notes; ?> </strong>
									<hr>
								</div>

							</div>
						</div>


						<div class="row-fluid">
							<div class="span12">
								<div class="span3 muted">
									<i class="icon-user"></i>
									<?php echo JText::_('COM_TASKMAN_TASKMAN_ASSIGNEE_LABEL');?>

								</div>
								<div class="span8">
									<strong><?php echo $item->asignee; ?> </strong>
								</div>

							</div>
						</div>


						<div class="row-fluid">
							<div class="span12">


								<div class="span2 muted" id="projectid" onclick="changedata(1,<?php echo $item->task_id; ?>)">
									<?php echo JText::_('COM_TASKMAN_TASKMAN_PROJECTS_LABEL');?>
								</div>
								<div class="span1" onclick="changedata(1,<?php echo $item->task_id; ?>)" > <i class="icon-edit"></i> </div>
								<div class="span8">
									<div id="distext<?php echo $item->task_id; ?>"></div>
									<div id="protexthide<?php echo $item->task_id; ?>">
										<strong><?php 	echo $item->projects; ?> </strong>
									</div>
									<div id="protext<?php echo $item->task_id; ?>">
										<input type="text" id="valtext<?php echo $item->task_id; ?>" name="protext"
											class="input-medium" value="<?php 	echo $item->projects; ?>" />
									<input type="button" class="button" onclick="saveProject(<?php echo $item->task_id; ?>)" value="save"/>
								<!-- <button name="but" onclick="saveProject(<?php echo $item->task_id; ?>)">Submit</button> -->
									</div>

								</div>

							</div>
						</div>



						<div class="row-fluid">
							<div class="span12">

								<div class="span3 muted">
									<i class="icon-calendar"></i>
									<?php echo JText::_('COM_TASKMAN_TASKMAN_DUEDATE_LABEL');?>

								</div>
								<div class="span3">
									<b id="duedate_result"><?php echo $item->duedate; ?> </b>
								</div>
								<div class="span3">
									<?php 
									$attribs = Array(
											'onchange' => "saveDate(this,$item->task_id)",
											'style'=>'display:none;'
									);
							echo JHtml::calendar($item->duedate, 'duedate', 'duedate','%Y-%m-%d',$attribs );  ?>


								</div>
							</div>

							<div class="row-fluid">
								<div class="span12">


									<div class="span2 muted" id="projectid" onclick="changedata(2)">
										<i class="icon-search"></i>
										<?php echo JText::_('COM_TASKMAN_TASKMAN_TAGS_LABEL');?>

									</div>
									<div class="span1" onclick="changedata(2)" > <i class="icon-edit"></i> </div>
									<div class="span8">

										<div id="distag<?php echo $item->task_id; ?>"></div>
										<div id="tagshide<?php echo $item->task_id; ?>">
											<strong><?php echo $item->tags; ?> </strong>
										</div>
										<div id="tagsshow<?php echo $item->task_id; ?>">
											<input type="text" id="valtags<?php echo $item->task_id; ?>" name="tagstext"
												class="input-medium" value="<?php 	echo $item->tags; ?>" />
											<button name="but2" onclick="saveTags(<?php echo $item->task_id; ?>)">Submit</button>
										</div>
									</div>


								</div>
							</div>


							<div class="row-fluid">
								<div class="span12">

									<div class="span3 muted">
										<?php echo JText::_('COM_TASKMAN_TASKMAN_FOLLOWERS_LABEL');?>
									</div>
									<div class="span8">
										<strong><?php echo $item->followers; ?> </strong>

									</div>


								</div>
							</div>

							<div class="row-fluid">
								<div class="span12">
									<div class="span3 muted">
										<?php echo JText::_('COM_TASKMAN_TASKMAN_ACTIVITY_FEED_LABEL');?>
									</div>
									<div class="span8">
										<strong><?php echo $item->feed; ?> </strong>

									</div>

								</div>
							</div>


							<div class="row-fluid">
								<div class="span12 muted">

									<strong><?php echo $item->comments; ?> </strong>



								</div>
							</div>


						</div>

					</div>


				</div>

			</div>
			<?php endforeach; ?>


</div>

			


		</div>
	</div>

</form>
