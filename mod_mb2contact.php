<?php 
/**
 * @package		Mb2 Fun Facts
 * @version		1.0.0
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2016 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		Commercial (http://codecanyon.net/licenses)
**/

// no direct access
defined('_JEXEC') or die();

require_once __DIR__ . '/helper.php';


// Get module styles and scripts
modMb2contactHelper::moduleHeading($params, array('pref'=>'.mb2funfacts' . $module->id));

//modMb2contactHelper::sendEmail($params,array('from'=>array('sasasa@sasa.com','My Name'),'to'=>'sddsdsds@asasa.com','subject'=>'sdsdsdsds','body'=>'dsdsdsdsdsdsdsds2345343'));

// Get module layout
require JModuleHelper::getLayoutPath('mod_mb2contact', $params->get('layout','default'));