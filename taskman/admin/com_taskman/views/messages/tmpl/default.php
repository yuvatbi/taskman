<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');


$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

?>

<script type="text/javascript">
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

<form	action="<?php echo JRoute::_('index.php?option=com_helloworldtwo&view=messages'); ?>" 	
	method="post" name="adminForm" id="adminForm">
	<?php if(!empty( $this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
		<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
	
	<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE');?></label>
				<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('HELLOWORLD_TASK_SEARCH'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE'); ?>" />
			</div>
			<div class="btn-group pull-left">
				<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
				<button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC');?></label>
				<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?></option>
					<option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?></option>
					<option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?></option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY');?></label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>
					<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
				</select>
			</div>
		</div>
		<div class="clearfix"> </div>
        <table class="table table-striped">
                <thead>
                <tr>
        <th width="5">
											<!-- arg1-text, arg2-db query name, arg3,4 ordering default values -->
				<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_ID', 'id', $listDirn, $listOrder); ?>
        </th>
        <th width="20">
                <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
        </th>                   
        
        <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_STATUS', 'published', $listDirn, $listOrder); ?>
        </th>
        
        
        <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_NAME', 'name', $listDirn, $listOrder); ?>
        </th>
        
         <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_EMAIL', 'email', $listDirn, $listOrder); ?>
                
        </th>
        
         <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_BIO', 'bio', $listDirn, $listOrder); ?>
        </th>
        
         <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_DOB', 'dob', $listDirn, $listOrder); ?>
                
        </th>
        
         <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_GENDER', 'gender', $listDirn, $listOrder); ?>
        </th>
        
         <th>
             	<?php echo JHtml::_('grid.sort', 'HELLOWORLD_MSGS_IMAGE', 'image', $listDirn, $listOrder); ?>
                
        </th>
</tr>

                </thead>
                <tfoot>
                <tr>
        <td colspan="3"><?php echo $this->pagination->getListFooter(); ?></td>
</tr>

                </tfoot>
                <tbody>
                <?php foreach($this->items as $i => $item): 
                
                $canChange=1;
                
                ?>
                
				<tr class="row<?php echo $i % 2; ?>">
                <td>
                        <?php echo $item->id; ?>
                </td>
                <td>
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                </td>
                <td>
                        <?php echo JHtml::_('jgrid.published', $item->published, $i, 'message.', $canChange, 'cb'); ?>
                        <?php echo $item->published; ?>
                </td>
                <td>
                        <?php echo $item->name; ?>
                </td>
                <td>
                        <?php echo $item->email; ?>
                </td>
                 <td>
                        <?php echo substr($item->bio,0,25); ?>
                </td>
                <td>
                        <?php echo $item->dob; ?>
                </td>
                 <td>
                        <?php echo $item->gender; ?>
                </td>
                <td>
                        <?php echo $item->image; ?>
                </td>
              
        </tr>
<?php endforeach; ?>

                </tbody>
        </table>
        
        <div>
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>
