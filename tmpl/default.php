<?php
/**
 * @package		Mb2 Fun Facts
 * @version		1.0.0
 * @author		Mariusz Boloz (http://mb2extensions.com)
 * @copyright	Copyright (C) 2016 Mariusz Boloz (http://mb2extensions.com). All rights reserved
 * @license		Commercial (http://codecanyon.net/licenses)
**/

// no direct access
defined('_JEXEC') or die;

$formurl = JURI::current();

?>
<div class="mb2contact" data-requiredmsg="<?php echo JText::_('MOD_MB2CONTACT_REQUIRED_FIELD_MESSAGE'); ?>" data-emailvalidmsg="<?php echo JText::_('MOD_MB2CONTACT_EMAIL_VALID_MESSAGE'); ?>">
	<?php if ($params->get('beforetext','') != '') : ?>
    	<div class="mb2contact-beforetext">
        	<?php echo JHtml::_('content.prepare', $params->get('beforetext','')); ?>
        </div><!-- //end .mb2contact-beforetext -->
    <?php endif; ?>
    <form id="mb2contactform" class="" action="<?php echo $formurl; ?>" method="post"> 
		<?php if ($params->get('formlayout',1) == 2) : ?>
        	<div class="mb2contact-row">
                <div class="mb2contact-col-2">
                    <?php echo modMb2contactHelper::formField($params,'name'); ?>
                    <?php echo modMb2contactHelper::formField($params,'email'); ?>
                    <?php echo modMb2contactHelper::formField($params,'subject'); ?>
                </div><!-- //end .mb2contact-col-2 -->
                <div class="mb2contact-col-2">
                    <?php echo modMb2contactHelper::formField($params,'message'); ?>                    
                </div><!-- //end .mb2contact-col-2 -->
            </div><!-- //end .mb2contact-row -->
            <div class="mb2contact-row">            	
              	<div class="mb2contact-col-1">
				<?php echo modMb2contactHelper::formField($params,'human'); ?>
                </div><!-- //end .mb2contact-col-1 -->
            </div><!-- //end .mb2contact-row -->
            <?php if ($params->get('sendcopy',0) == 1) : ?> 
                <div class="mb2contact-row">            	
                    <div class="mb2contact-col-1">
                    <?php echo modMb2contactHelper::formField($params,'copy'); ?>
                    </div><!-- //end .mb2contact-col-1 -->
                </div><!-- //end .mb2contact-row -->
            <?php endif; ?>
            <div class="mb2contact-row">            	
              	<div class="mb2contact-col-1">
				<?php echo modMb2contactHelper::formField($params,'button'); ?>
                </div><!-- //end .mb2contact-col-1 -->
            </div><!-- //end .mb2contact-row -->
       	<?php elseif($params->get('formlayout',1) == 3) : ?>
       		<div class="mb2contact-row">
                <div class="mb2contact-col-3">
                    <?php echo modMb2contactHelper::formField($params,'name'); ?>
                </div><!-- //end .mb2contact-col-3 -->
                <div class="mb2contact-col-3">
                    <?php echo modMb2contactHelper::formField($params,'email'); ?>
                </div><!-- //end .mb2contact-col-3 -->
                <div class="mb2contact-col-3">
                    <?php echo modMb2contactHelper::formField($params,'subject'); ?>
                </div><!-- //end .mb2contact-col-3 -->                
            </div><!-- //end .mb2contact-row -->
            <div class="mb2contact-row">            	
              	<div class="mb2contact-col-1">
                    <?php echo modMb2contactHelper::formField($params,'message'); ?>                    
                </div><!-- //end .mb2contact-col-1 -->
            </div><!-- //end .mb2contact-row --> 
            <div class="mb2contact-row">            	
              	<div class="mb2contact-col-1">
				<?php echo modMb2contactHelper::formField($params,'human'); ?>
                </div><!-- //end .mb2contact-col-1 -->
            </div><!-- //end .mb2contact-row -->
            <?php if ($params->get('sendcopy',0) == 1) : ?> 
                <div class="mb2contact-row">            	
                    <div class="mb2contact-col-1">
                    <?php echo modMb2contactHelper::formField($params,'copy'); ?>
                    </div><!-- //end .mb2contact-col-1 -->
                </div><!-- //end .mb2contact-row -->
            <?php endif; ?>
            <div class="mb2contact-row">            	
              	<div class="mb2contact-col-1">
				<?php echo modMb2contactHelper::formField($params,'button'); ?>
                </div><!-- //end .mb2contact-col-1 -->
            </div><!-- //end .mb2contact-row -->
        <?php else : ?>
			<?php echo modMb2contactHelper::formField($params,'name'); ?>
            <?php echo modMb2contactHelper::formField($params,'email'); ?>
            <?php echo modMb2contactHelper::formField($params,'subject'); ?>
            <?php echo modMb2contactHelper::formField($params,'message'); ?>
            <?php echo modMb2contactHelper::formField($params,'human'); ?>
            <?php if ($params->get('sendcopy',0) == 1) : ?> 
                <?php echo modMb2contactHelper::formField($params,'copy'); ?>
            <?php endif; ?>
            <?php echo modMb2contactHelper::formField($params,'button'); ?>
        <?php endif; ?>
    </form>
    <img id="mb2contact-ajax-loading" src="<?php echo JURI::base(true); ?>/media/mb2contact/images/loading.gif" alt="" />
   <div class="mb2contactmessage"></div>
   <?php if ($params->get('aftertext','') != '') : ?>
    	<div class="mb2contact-aftertext">
        	<?php echo JHtml::_('content.prepare', $params->get('aftertext','')); ?>
        </div><!-- //end .mb2contact-aftertext -->
    <?php endif; ?>
</div><!-- //end .mb2contact -->