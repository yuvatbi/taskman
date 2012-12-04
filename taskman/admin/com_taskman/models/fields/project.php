<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * HelloWorld Form Field class for the HelloWorld component
 */
class JFormFieldProject extends JFormFieldList
{
        /**
         * The field type.
         *
         * @var         string
         */
        protected $type = 'Task';
 
        /**
         * Method to get a list of options for a list input.
         *
         * @return      array           An array of JHtml options.
         */
        protected function getOptions() 
        {
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                $query->select('project_id,project_name');
                $query->from('#__taskman_projects');
                $db->setQuery((string)$query);
                $messages = $db->loadObjectList();
                $options = array();
                if ($messages)
                {
                        foreach($messages as $message) 
                        {
                                $options[] = JHtml::_('select.option', $message->project_id, $message->project_name);
                        }
                }
                $options = array_merge(parent::getOptions(), $options);
                return $options;
        }
}
