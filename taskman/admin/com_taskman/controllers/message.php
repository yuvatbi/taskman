<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
 
/**
 * HelloWorld Controller
 */
class HelloWorldTwoControllerMessage extends JControllerForm
{

	/*
	 * 
	function save()
	{
			$name = JRequest::getVar('jform');
			print_r($name);
			//echo $name['name'];
			exit;
	}
	
	
	function edit()
	{
			$ss = JFactory::getApplication()->input;
			print_r($ss);
			exit;
	}
	* 
	* 
	* 
	**/
	
	
	function save()
	{
		
		$app = JFactory::getApplication();       //for two
		//$post = $app->input->get('jform');  //for two
		$post = JRequest::get('post');
		//print_r($post);                          //for one
		//print_r($app->input);                    //for two
		//exit;
		//echo $id = $post['id'];
		 $id = $post['jform']['id'];
		 
		//$table = $this->getTable();
		$model = $this->getModel('message');
		
		if(!$model->save($post))
		{
			//throw error
			echo "error";
			$app->redirect(JRoute::_('index.php?option=com_helloworldtwo&view=message&layout=edit&id='.$id),'save failure','error');
		}
		
		
		$app->redirect(JRoute::_('index.php?option=com_helloworldtwo&view=messages'),'save success','Message');
		
	}

}
