<?php
/**
 * @package		Mb2 Contact
 * @version		1.1.2
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2016 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
**/



defined('_JEXEC') or die;


abstract class modMb2contactHelper
{
	
	
	
	/*
	 *
	 * Method to set email
	 *
	 */
	public static function sendEmailAjax() 
	{
		
		
		$mailer = JFactory::getMailer();
		$app = JFactory::getApplication();
		$input = $app->input;
		
		
		// Get module params
		$jInput = JFactory::getApplication()->input;
		$module = JModuleHelper::getModule('mod_mb2contact',self::getModuleTitle($jInput->get('modid')));
		$mparams = new JRegistry($module->params);
		
		
		// Get data from contact form
		$name = $input->get('mb2_name', '', 'string');
		$email = $input->get('mb2_email', '', 'email');
		$subject = $input->get('mb2_subject', '', 'string');
		$message = $input->get('mb2_message', '', 'string');
		$human = $input->get('mb2_human', '', 'string');
		$sendcopy = $mparams->get('sendcopy',0) == 1 ? $input->get('mb2_sendcopy') : 0;
				
		
		// Set mailer elements
		$senderemail = $mparams->get('sendfrom','') !='' ? $mparams->get('sendfrom','') : $email;
		$sendername = $mparams->get('sendfromname','') !='' ? $mparams->get('sendfromname','') : $name;
		
		
		// Set body 
		$body   = $name . ' <' . $email . '>' . "\r\n\r\n" . stripslashes($message);
		
		
		$mailer->setSender(array($senderemail,$sendername));		
		$mailer->addRecipient($mparams->get('sendto',''));		
		$mailer->setSubject($mparams->get('subjectpref','Mb2 Contact') . ': ' . $subject);		
		$mailer->setBody($body);
		
		
		// Send copy of email
		if ($sendcopy == 1)
		{
			$mailer->addBCC($email);
		}
		
		
		// Check human validation
		$humananswer_nospace = str_replace(' ', '', $mparams->get('humananswer'));
		$humananswer_arr = explode(',' , $humananswer_nospace);
		
		if (!in_array($human, $humananswer_arr))
		{
			echo '<span class="mb2contact-msg-error">' . JText::_('MOD_MB2CONTACT_ISHUMAN_ERROR_MESSAGE') . '</span><span class="mb2contact-mtype" data-type="error"></span>';
			return false;
		}
		
		
		if ($mailer->send()!== true)
		{
			echo '<span class="mb2contact-msg-error">' . JText::_('MOD_MB2CONTACT_SEND_ERROR_MESSAGE') . '</span><span class="mb2contact-mtype" data-type="error"></span>';
		}
		else
		{
			echo '<span class="mb2contact-msg-success">' . JText::_('MOD_MB2CONTACT_SEND_SUCCESS_MESSAGE') . '</span><span class="mb2contact-mtype" data-type="success"></span>'; 	
		}
		
		
	}
	
	
	
	
	/*
	 *
	 * Method to get module title by module id
	 *
	 */
	public static function getModuleTitle($id=0)
	{
		
		$db = JFactory::getDBO();
		
		$query = "SELECT `title` FROM #__modules WHERE client_id=0 AND id=" . $id;
		$db->setQuery($query);
		return $db->loadResult();		
		
	}
	
	
	
	
	/*
	 *
	 * Method to get form field
	 *
	 */
	public static function formField(&$params, $name, $attribs = array()) 
	{
		
		$output = '';
		
		
		$output .= '<div class="mb2formgroup">';
		
		
		switch ($name)
		{
			case 'name':
			$placeholder = $params->get('uselabel',1) == 0 ? ' placeholder="' . JText::_('MOD_MB2CONTACT_NAME_LABEL') . '"' : '';
			$output .= $params->get('uselabel',1) ? '<div class="mb2contact-label"><label for="mb2_name">' .  JText::_('MOD_MB2CONTACT_NAME_LABEL') . '</label></div>' : '';			
			$output .= '<div class="mb2contact-field"><input name="mb2_name" id="mb2_name" type="text" value=""' . $placeholder . '></div>';
			break;	
			
			case 'email':
			$placeholder = $params->get('uselabel',1) == 0 ? ' placeholder="' . JText::_('MOD_MB2CONTACT_EMAIL_LABEL') . '"' : '';
			$output .= $params->get('uselabel',1) ? '<div class="mb2contact-label"><label for="mb2_email">' .  JText::_('MOD_MB2CONTACT_EMAIL_LABEL') . '</label></div>' : '';			
			$output .= '<div class="mb2contact-field"><input name="mb2_email" id="mb2_email" type="text" value=""' . $placeholder . '></div>';
			break;
			
			case 'subject':
			$placeholder = $params->get('uselabel',1) == 0 ? ' placeholder="' . JText::_('MOD_MB2CONTACT_SUBJECT_LABEL') . '"' : '';
			$output .= $params->get('uselabel',1) ? '<div class="mb2contact-label"><label for="mb2_subject">' .  JText::_('MOD_MB2CONTACT_SUBJECT_LABEL') . '</label></div>' : '';			
			$output .= '<div class="mb2contact-field"><input name="mb2_subject" id="mb2_subject" type="text" value=""' . $placeholder . '></div>';
			break;
			
			case 'message':
			$placeholder = $params->get('uselabel',1) == 0 ? ' placeholder="' . JText::_('MOD_MB2CONTACT_MESSAGE_LABEL') . '"' : '';
			$output .= $params->get('uselabel',1) ? '<div class="mb2contact-label"><label for="mb2_message">' .  JText::_('MOD_MB2CONTACT_MESSAGE_LABEL') . '</label></div>' : '';			
			$output .= '<div class="mb2contact-field"><textarea name="mb2_message" id="mb2_message"' . $placeholder . '></textarea></div>';
			break;
			
			case 'human':	
			$placeholder = $params->get('usehumanlabel',1) == 0 ? ' placeholder="' . $params->get('humananquestion', 'What is 3 plus 2?') . '"' : '';		
			$output .= $params->get('usehumanlabel',1) == 1 ? 
			'<div class="mb2contact-label mb2contact-human-label"><label for="mb2_human">' . $params->get('humananquestion', 'What is 3 plus 2?') . '</label></div>' : '';	
			$output .= '<div class="mb2contact-field mb2contact-human-input"><input name="mb2_human" id="mb2_human" type="text" value=""' . $placeholder . '></div>';
			break;
			
			case 'copy':
			$output .= $params->get('sendcopy',0) == 1 ? '<input type="checkbox" name="mb2_sendcopy" id="mb2_sendcopy" value="1"> <label for="mb2_sendcopy">' .  JText::_('MOD_MB2CONTACT_COPY_LABEL') . '</label>' : '';	
			break;		
			
			case 'button':
			$btnstyle = $params->get('buttonfull',1) == 1 ? ' style="width:100%;"' : '';		
			$output .= '<input id="mb2contact-formbtn" class="' . $params->get('buttoncls','btn btn-primary btn-lg') . '" type="submit" value="' .  JText::_('MOD_MB2CONTACT_SUBMIT') . '"' . $btnstyle . ' >';	
				
            
			
		}
		
		
		$output .= '</div><!-- //end .mb2formgroup -->';
		
		return $output;	
		
		
	}
	
	
	
		
		
		
	
	
	/*
	 *
	 * Method to get facts array
	 *
	 */
	public static function moduleClass(&$params, $attribs = array()) 
	{
		
		$output = '';
				
		$output .= ' ' . $attribs['pref'] . $attribs['modid'];
		$output .= ' layout' . $params->get('factlayout',1);		
		$output .= ' ' . $attribs['pref'] . '-clr';		
		
		return $output;
	}
	
	
	
	
	
	
	
	/*
	 *
	 * Method to get facts data attribs
	 *
	 */
	public static function formData(&$params, $attribs = array()) 
	{
		
		$output = '';
		
		$output .= ' data-modid="' . $attribs['modid'] . '"';
		
		return $output;
	}
	
	
	
	
	
	/*
	 *
	 * Method to get module scripts and styles
	 *
	 */
	public static function moduleHeading(&$params, $attribs = array())
	{
				
		// Joomla core variables
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();
					
		
		// Get module style
		// Check if use have module css file in template css directory
		if (file_exists( JPATH_THEMES . '/' . $app->getTemplate() . '/css/mb2contact.css' ))
		{			
			$doc->addStylesheet(JURI::base(true) . '/templates/' . $app->getTemplate() . '/css/mb2contact.css');						
		}
		else
		{
			$doc->addStylesheet(JURI::base(true) . '/media/mb2contact/css/mb2contact.css');
		}
		
	
		
		// Get module script
		// Get jquery framework
		JHtml::_('jquery.framework');
		
		
		//if (!modMb2contactHelper::isDeclaration('jquery.animateNumber.min.js') && $params->get('animateNumber', 1))
//		{		
//			$doc->addScript(JURI::base(true) . '/media/mb2funfacts/js/jquery.animateNumber.min.js');
//		}
//		
//		if (!modMb2contactHelper::isDeclaration('jquery.inview.min.js') && $params->get('inview', 1))
//		{		
//			$doc->addScript(JURI::base(true) . '/media/mb2funfacts/js/jquery.inview.min.js');
//		}		
		
		
		if (file_exists(JPATH_THEMES . '/' . $app->getTemplate() . '/js/mb2contact.js'))
		{
			$doc->addScript(JURI::base(true) . '/templates/' . $app->getTemplate() . '/js/mb2contact.js');
		}
		else
		{
			$doc->addScript(JURI::base(true) . '/media/mb2contact/js/mb2contact.js');	
		}
		
		
		
		
		
		// Inline styles
		modMb2contactHelper::inlineStyle($params, $attribs)!='' ? $doc->addStyleDeclaration(modMb2contactHelper::inlineStyle($params, $attribs)) : '';
		
		
		
			
	}
	
	
	
	
	
	
	/**
	 *
	 * Method to check loading script and styles
	 *
	 */	
	public static function isDeclaration($name)
	{
				
		
		$doc = JFactory::getDocument();				
		$declarationarr = preg_match('@.css@',$name) ? $doc->_styleSheets : $doc->_scripts;
			
		foreach ($declarationarr as $k=>$v)
		{					
			if (preg_match('@' . $name . '@', $k))
			{				
				return true;		
			}			
		}
		
		return false;				
		
	}
	
	
	
	
	
	
	/*
	 *
	 * Method to get module scripts and styles
	 *
	 */
	public static function inlineStyle(&$params, $attribs = array())
	{
		
		$doc = JFactory::getDocument();
		
		$css = '';
			
		
		// Min height of textarea
		
		$css .= '#mb2_message';
		$css .= '{';
		$css .= 'min-height:' . $params->get('textminheight', 220) . 'px;';
		$css .= '}';
		
		
		
		// Custom css
		$css .= $params->get('customcss', '');
		
		
		return $css;		
		
		
	}
	
	
	
	
	
	
	
	
	
}