<?php 
/**
 * @package		Mb2 Contact
 * @version		1.1.2
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2016 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
**/

// no direct access
defined('_JEXEC') or die();

require_once __DIR__ . '/helper.php';


// Get module styles and scripts
modMb2contactHelper::moduleHeading($params, array('pref'=>'.mb2funfacts' . $module->id));


// Get module layout
require JModuleHelper::getLayoutPath('mod_mb2contact', $params->get('layout','default'));