<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');
 
/**
 * HelloWorld View
 */
class TaskManViewTask extends JViewLegacy
{
        /**
         * display method of Hello view
         * @return void
         */
        public function display($tpl = null) 
        {
                // get the Data
               
                $form = $this->get('Form');
               // print_r($form);
				//exit;
                
                $item = $this->get('Item');
			
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                // Assign the Data
                $this->form = $form;
                $this->item = $item;
                //print_r($item);
 
                // Set the toolbar
                $this->addToolBar();
        $this->setDocument();
                
                // Display the template
                parent::display($tpl);
        }
 
        /**
         * Setting the toolbar
         */
        protected function addToolBar() 
        {
                $input = JFactory::getApplication()->input;
                $input->set('hidemainmenu', true);
                $isNew = ($this->item->task_id == 0);
                JToolBarHelper::title($isNew ? JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_NEW')
                                             : JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_EDIT'));
                JToolBarHelper::save('task.save');
                JToolBarHelper::cancel('task.cancel', $isNew ? 'JTOOLBAR_CANCEL'
                                                                   : 'JTOOLBAR_CLOSE');
        }
        protected function setDocument() 
        {
                $isNew = ($this->item->task_id < 1);
                $document = JFactory::getDocument();
                $document->setTitle($isNew ? JText::_('HELLOWORLD_CREATE')
                                           : JText::_('HELLOWORLD_EDIT'));
        }
}
