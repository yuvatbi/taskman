<?php

defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.view');

class TaskManViewFile extends JViewLegacy
{
	
	function display($tpl=null)
	{
		$this->msg = "helo";
			parent::display($tpl);
	}
	
	
}
