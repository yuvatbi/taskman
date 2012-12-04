<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * General Controller of HelloWorld component
 */
class TaskManController extends JControllerLegacy
{
        /**
         * display task
         *
         * @return void
         */
        function display($cachable = false,$urlparams=false) 
        {
                // set default view if not set
                JRequest::setVar('view', JRequest::getCmd('view', 'Tasks'));
 
                // call parent behavior
                parent::display($cachable);
                
        }
}
