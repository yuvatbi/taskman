<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');
 
/**
 * HelloWorlds View
 */
class TaskManViewTasks extends JViewLegacy
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
                $pagination = $this->get('Pagination');
 
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
				$this->setDocument();
                // Display the template
                parent::display($tpl);
        }
         protected function addToolBar() 
        {
          $input=JFactory::getApplication()->input;
          //$input->set('hidemainmenu',true);
        //  $isNew=($this->item->id=0);
          //JToolBarHelper::title($isNew ? JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_NEW')
           //                                  : JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_EDIT'));
               JToolBarHelper::title(JText::_('COM_HELLODEMO_MANAGER_TASKS'));
                JToolBarHelper::addNew('task.add');
               JToolBarHelper::editList('task.edit');
                JToolBarHelper::deleteList('','tasks.delete');
                 JToolBarHelper::publish('tasks.publish', 'JTOOLBAR_PUBLISH', true);
               
               
               
               
               JToolbarHelper::help('JHELP_COMPONENTS_WEBLINKS_LINKS');



		JHtmlSidebar::setAction('index.php?option=com_taskman&view=tasks');

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
//}
