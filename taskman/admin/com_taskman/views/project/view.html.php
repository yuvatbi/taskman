<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HelloWorld View
 */
class TaskManViewProject extends JViewLegacy
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
                $isNew = ($this->item->project_id == 0);
                JToolBarHelper::title($isNew ? JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_NEW')
                                             : JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_EDIT'));
                JToolBarHelper::save('project.save');
                JToolBarHelper::cancel('project.cancel', $isNew ? 'JTOOLBAR_CANCEL'
                                                                   : 'JTOOLBAR_CLOSE');
        }
        protected function setDocument() 
        {
                $isNew = ($this->item->project_id < 1);
                $document = JFactory::getDocument();
                $document->setTitle($isNew ? JText::_('HELLOWORLD_CREATE')
                                           : JText::_('HELLOWORLD_EDIT'));
        }
}
