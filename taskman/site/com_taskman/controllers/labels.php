<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * HelloWorlds Controller
 */
class TaskManControllerLabels extends JControllerAdmin
{
        /**
         * Proxy for getModel.
         * @since       2.5
         */
        public function getModel($name = 'label', $prefix = 'TaskManModel') 
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }
}
