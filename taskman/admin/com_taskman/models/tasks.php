<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * HelloWorldList Model
 */
class TaskManModelTasks extends JModelList
{
  protected function populateState($ordering = null, $direction = null)
	{
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);
		
		
		// List state information.
		parent::populateState('title', 'asc');
	}

        /**
         * Method to build an SQL query to load the list data.
         *
         * @return      string  An SQL query
         */
        protected function getListQuery()
        {
                // Create a new query object.           
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                
                // Select some fields
	                $query->select('task_id,title,notes,asignee,projects,subtasks,comments,duedate,tags,file,followers,follow,feed');
	                // From the hello table
	                $query->from('#__taskman_tasks');
	                
	                
					// Add the list ordering clause.
					$orderCol	= $this->state->get('list.ordering');
					$orderDirn	= $this->state->get('list.direction');
					//if ($orderCol == 'name') {
						$orderCol = 'title';
					//}
					//$query->order($db->escape($orderCol.' '.$orderDirn));
					//print_r($query);
					
						
					/*
					 * 
					 * 
					 * 
					 
					echo $query;
					exit;
					
					*/
					
						// Filter by search in title
						$search = $this->getState('filter.search');
						if (!empty($search)) {
							if (stripos($search, 'id:') === 0) {
								$query->where('task_id = '.(int) substr($search, 3));
							} else {
								$search = $db->Quote('%'.$db->escape($search, true).'%');
								$query->where('(title LIKE '.$search.' OR projects LIKE '.$search.')');
							}
						}
					
					
					$published = $this->getState('filter.state');
					if (is_numeric($published)) {
						$query->where('state = '.(int) $published);
					} elseif ($published === '') {
						$query->where('(state IN (0, 1))');
					}

		
                return $query;
        }
        
        
        function getNameOptions()
        {
		
				$db = JFactory::getDBO();
				$query = $db->getQuery(true);
				
				$query->select('name');
				
				$query->from('#__taskman_tasks');
				
				$db->setQuery($query);
				
				
			
		}
        
        
}
