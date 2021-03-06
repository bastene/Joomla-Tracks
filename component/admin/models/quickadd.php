<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
require_once (JPATH_COMPONENT.DS.'models'.DS.'list.php');

/**
 * Joomla Tracks Component person search Model
 *
 * @package     Tracks
 * @since 0.2
 */
class TracksModelQuickAdd extends JModel
{

	function getList($query)
	{
        $sql = "SELECT * ";
        $sql .= "FROM #__tracks_individuals i ";
        $sql .= "WHERE LOWER( CONCAT(i.first_name, ' ', i.last_name) ) LIKE ".$this->_db->Quote("%".$query."%")." ";
        $sql .= "OR alias LIKE ".$this->_db->Quote("%".$query."%")." ";
        $sql .= "OR nickname LIKE ".$this->_db->Quote("%".$query."%")." ";
        $sql .= "OR id = ".$this->_db->Quote($query);
		$results = $this->_getList($sql);
		return $results;
	}

}

?>
