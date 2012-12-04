<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HelloWorlds View
 */
class HelloWorldTwoViewMessages extends JViewLegacy
{
        /**
         * HelloWorlds view display method
         * @return void
         */
        function display($tpl = null) 
        {
                // Get data from the model
                $state = $this->get('State');
                $items = $this->get('Items');
               
               /* 
                print_r($items);
                exit;
                * 
                * */
                
                
                $pagination = $this->get('Pagination');
                
                
                /*
				print_r($pagination);
                exit;
                * 
                * */
                
                
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                // Assign data to the view
                 $this->state = $state;
                $this->items = $items;
                $this->pagination = $pagination;
 
				   $this->addToolBar();
				   $this->sidebar = JHtmlSidebar::render();
                // Display the template
                parent::display($tpl);
        }
        
        
        protected function addToolBar() 
        {
                JToolBarHelper::title(JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLDS'));
                JToolBarHelper::addNew('message.add');
                JToolBarHelper::editList('message.edit');
                JToolBarHelper::deleteList('', 'messages.delete');
                
            JToolbarHelper::publish('messages.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('messages.unpublish', 'JTOOLBAR_UNPUBLISH', true);

                          
               
               
               JToolbarHelper::help('JHELP_COMPONENTS_WEBLINKS_LINKS');

		JHtmlSidebar::setAction('index.php?option=com_helloworldtwo&view=messages');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_state',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);

		$filter_name_options = $this->get('NameOptions');
		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_name',
			JHtml::_('select.options', $filter_name_options, 'value', 'text', $this->state->get('filter.name'), true)
		);

		
                     
        }
            protected function setDocument() 
        {
                $document = JFactory::getDocument();
                $document->setTitle(JText::_('HELLOWORLD_MESSAGE'));
        }
               
                
               
        
}
