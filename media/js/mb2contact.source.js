/**
 * @package		Mb2 Contact
 * @version		1.0.0
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2016 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
**/ 
 
jQuery(document).ready(function($){
	
	
	
	$('#mb2contactform').submit(function(e){
		
		e.preventDefault();
		
		var form = $(this);		
		var formAction = form.attr('action') + '?option=com_ajax&module=mb2contact&method=sendEmail&format=raw';
		var messageDiv = $('.mb2contactmessage');
		var loadingImg = $('#mb2contact-ajax-loading');
		var formButton = form.find('#mb2contact-formbtn');
		
		
		// Validate form
		var returnError = false;
		var field_name = form.find('#mb2_name');
		var field_email = form.find('#mb2_email');
		var field_subject = form.find('#mb2_subject');
		var field_message = form.find('#mb2_message');
		var field_human = form.find('#mb2_human');
		var message_div = '<span class="mb2contact-form-message"></span>';
		var error_text = form.parent().data('requiredmsg');
		var email_error_text = form.parent().data('emailvalidmsg');
		
		
		
		
		if (field_name.val() == '') {			
			field_name.addClass('mb2contact-form-field-error');
			var message_parent = field_name.parent();			
			(!message_parent.find('.mb2contact-form-message')[0]) ? message_parent.append(message_div) : '';
			var name_message = message_parent.find('.mb2contact-form-message');			
			name_message.html(error_text);
           	returnError = true;			
		}
		else
		{			
			field_name.removeClass('mb2contact-form-field-error');	
			var message_parent = field_name.parent();	
			var name_message = message_parent.find('.mb2contact-form-message');
			name_message.remove();			 
		}
		
		
		if (field_email.val() == '') {			
			
			
			
			field_email.addClass('mb2contact-form-field-error');
			var message_parent = field_email.parent();			
			(!message_parent.find('.mb2contact-form-message')[0]) ? message_parent.append(message_div) : '';
			var email_message = message_parent.find('.mb2contact-form-message');			
			email_message.html(error_text);
           	returnError = true;			
		}
		else
		{						
			if (!checkEmail(field_email))
			{
				field_email.addClass('mb2contact-form-field-error');
				var message_parent = field_email.parent();			
				(!message_parent.find('.mb2contact-form-message')[0]) ? message_parent.append(message_div) : '';
				var email_message = message_parent.find('.mb2contact-form-message');			
				email_message.html(email_error_text);
				returnError = true;	
			}
			else
			{
				field_email.removeClass('mb2contact-form-field-error');	
				var message_parent = field_email.parent();	
				var email_message = message_parent.find('.mb2contact-form-message');
				email_message.remove();
			}					 
		}
		
		
		
		if (field_subject.val() == '') {			
			field_subject.addClass('mb2contact-form-field-error');
			var message_parent = field_subject.parent();			
			(!message_parent.find('.mb2contact-form-message')[0]) ? message_parent.append(message_div) : '';
			var subject_message = message_parent.find('.mb2contact-form-message');			
			subject_message.html(error_text);
           	returnError = true;			
		}
		else
		{			
			field_subject.removeClass('mb2contact-form-field-error');	
			var message_parent = field_subject.parent();	
			var subject_message = message_parent.find('.mb2contact-form-message');
			subject_message.remove();			 
		}
		
		
		
		if (field_message.val() == '') {			
			field_message.addClass('mb2contact-form-field-error');
			var message_parent = field_message.parent();			
			(!message_parent.find('.mb2contact-form-message')[0]) ? message_parent.append(message_div) : '';
			var message_message = message_parent.find('.mb2contact-form-message');			
			message_message.html(error_text);
           	returnError = true;			
		}
		else
		{			
			field_message.removeClass('mb2contact-form-field-error');	
			var message_parent = field_message.parent();	
			var message_message = message_parent.find('.mb2contact-form-message');
			message_message.remove();			 
		}
		
		
		
		
		if (field_human.val() == '') {			
			field_human.addClass('mb2contact-form-field-error');
			var message_parent = field_human.parent();			
			(!message_parent.find('.mb2contact-form-message')[0]) ? message_parent.append(message_div) : '';
			var human_message = message_parent.find('.mb2contact-form-message');			
			human_message.html(error_text);
           	returnError = true;			
		}
		else
		{			
			field_human.removeClass('mb2contact-form-field-error');	
			var message_parent = field_human.parent();	
			var human_message = message_parent.find('.mb2contact-form-message');
			human_message.remove();			 
		}
		
		
		
		// Check if form validation returns errors
		// If not submit form
		if(returnError == true){			
            return false;
        }	
		
		
		
		messageDiv.html('');
		loadingImg.show();
		formButton[0].disabled = true;
		formButton.css({opacity:.3});
		
		var formdata = new FormData($(this)[0]);
		
		$.ajax({
			url: formAction,
			type: 'POST',
			data: formdata,
    		cache: false,
    		contentType: false,
    		processData: false,
			success: function(response){		
										
				loadingImg.hide();
				formButton.css({opacity:1});
				
				formButton[0].disabled = false;
				messageDiv.html(response);
				
				var msgType = $('.mb2contact-mtype').data('type');
				
				
				
				if (msgType === 'success')
				{
					form.find('input[type="text"]').val('');	
					form.find('input[type="email"]').val('');
					form.find('textarea').val('');
				}
						
			}
			
		});
		
		
		
		
		
		
		
		
	});
	
	
	
	
	
	function checkEmail(email){		
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
		
		if (re.test(email.val()))
		{
			return true;
		}
		else
		{
			return false;	
		}			
	}
	
	
	
});