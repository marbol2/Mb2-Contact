/**
 * @package		Mb2 Testimonials
 * @version		1.3.0
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2015 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		Commercial (http://codecanyon.net/licenss)
**/ 
 jQuery(document).ready(function(a){function e(a){var e=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gim;return e.test(a.val())?!0:!1}a("#mb2contactform").submit(function(t){t.preventDefault();var m=a(this),r=m.attr("action")+"?option=com_ajax&module=mb2contact&method=sendEmail&format=raw",n=a(".mb2contactmessage"),o=a("#mb2contact-ajax-loading"),s=m.find("#mb2contact-formbtn"),c=!1,f=m.find("#mb2_name"),d=m.find("#mb2_email"),i=m.find("#mb2_subject"),l=m.find("#mb2_message"),b=m.find("#mb2_human"),v='<span class="mb2contact-form-message"></span>',p=m.parent().data("requiredmsg"),g=m.parent().data("emailvalidmsg");if(""==f.val()){f.addClass("mb2contact-form-field-error");var u=f.parent();u.find(".mb2contact-form-message")[0]?"":u.append(v);var h=u.find(".mb2contact-form-message");h.html(p),c=!0}else{f.removeClass("mb2contact-form-field-error");var u=f.parent(),h=u.find(".mb2contact-form-message");h.remove()}if(""==d.val()){d.addClass("mb2contact-form-field-error");var u=d.parent();u.find(".mb2contact-form-message")[0]?"":u.append(v);var C=u.find(".mb2contact-form-message");C.html(p),c=!0}else if(e(d)){d.removeClass("mb2contact-form-field-error");var u=d.parent(),C=u.find(".mb2contact-form-message");C.remove()}else{d.addClass("mb2contact-form-field-error");var u=d.parent();u.find(".mb2contact-form-message")[0]?"":u.append(v);var C=u.find(".mb2contact-form-message");C.html(g),c=!0}if(""==i.val()){i.addClass("mb2contact-form-field-error");var u=i.parent();u.find(".mb2contact-form-message")[0]?"":u.append(v);var y=u.find(".mb2contact-form-message");y.html(p),c=!0}else{i.removeClass("mb2contact-form-field-error");var u=i.parent(),y=u.find(".mb2contact-form-message");y.remove()}if(""==l.val()){l.addClass("mb2contact-form-field-error");var u=l.parent();u.find(".mb2contact-form-message")[0]?"":u.append(v);var _=u.find(".mb2contact-form-message");_.html(p),c=!0}else{l.removeClass("mb2contact-form-field-error");var u=l.parent(),_=u.find(".mb2contact-form-message");_.remove()}if(""==b.val()){b.addClass("mb2contact-form-field-error");var u=b.parent();u.find(".mb2contact-form-message")[0]?"":u.append(v);var j=u.find(".mb2contact-form-message");j.html(p),c=!0}else{b.removeClass("mb2contact-form-field-error");var u=b.parent(),j=u.find(".mb2contact-form-message");j.remove()}if(1==c)return!1;n.html(""),o.show(),s[0].disabled=!0,s.css({opacity:.3});var x=new FormData(a(this)[0]);a.ajax({url:r,type:"POST",data:x,cache:!1,contentType:!1,processData:!1,success:function(e){o.hide(),s.css({opacity:1}),s[0].disabled=!1,n.html(e);var t=a(".mb2contact-mtype").data("type");"success"===t&&(m.find('input[type="text"]').val(""),m.find('input[type="email"]').val(""),m.find("textarea").val(""))}})})});