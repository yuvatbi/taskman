<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import joomla controller library
jimport('joomla.application.component.controller');
 

$controller = JControllerLegacy::getInstance('TaskMan');


/*
$controller->execute(JRequest::getCmd('task'));


$ss = JFactory::getApplication()->input;
print_r($ss);
exit;
*/


$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();
