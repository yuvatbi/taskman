<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * HelloWorldList Model
 */
class HelloWorldTwoModelMessages extends JModelList
{
	
	
	
	protected function populateState($ordering = null, $direction = null)
	{
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);
		
		$name = $this->getUserStateFromRequest($this->context.'.filter.name', 'filter_name', '', 'string');
		$this->setState('filter.name', $name);
		
		
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
                $query->select('id,name,email,published,ordering,bio,dob,gender,image');
                // From the hello table
                $query->from('#__helloworld_message');
                
                
                
                $name = $this->getState('filter.name');
					if (!empty($name)) {
						$name = $db->Quote($db->escape($name));
						$query->where('name = '. $name);
					} 
					
					
					return $query;
        }
        
        
                function getNameOptions(){
			 // Create a new query object.           
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                
                // Select some fields
                //$query->select('DISTINCT name');
                $query->select('name');
                // From the hello table
                $query->from('#__helloworld_message');
				
				$db->setQuery($query);
				$result = $db->loadObjectList();
			
			foreach($result as $item){
				$name = $item->name;
				$filter_name_options[] = JHTML::_('select.option', $name , $name);
				}
			return $filter_name_options;
			
			}
			
}
