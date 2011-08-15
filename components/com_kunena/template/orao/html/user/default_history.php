<?php
/**
 * Kunena Component
 * @package Kunena
 *
 * @Copyright (C) 2008 - 2011 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$j=count($this->banhistory);
?>
<div class="forumlist">
	<div class="inner">
		<span class="corners-top"><span></span></span>
			<ul class="topiclist">
				<li class="header">
					<dl class="icon">
						<dt><?php echo JText::sprintf('COM_KUNENA_BAN_BANHISTORYFOR', $this->escape($this->profile->name)); ?></dt>
						<dd>&nbsp;</dd>
					</dl>
				</li>
			</ul>

	<div class="kdetailsbox kbanhistory" id="kbanhistory-detailsbox">
		<div class="kbody">
			<table class="kblocktable kbanhistory">
				<thead>
					<tr class="ksth">
						<th class="kcol-first kid"> # </th>
						<th class="kcol-mid kbanfrom"><?php echo JText::_('COM_KUNENA_BAN_BANNEDFROM'); ?></th>
						<th class="kcol-mid kbanstart"><?php echo JText::_('COM_KUNENA_BAN_STARTTIME'); ?></th>
						<th class="kcol-mid kbanexpire"><?php echo JText::_('COM_KUNENA_BAN_EXPIRETIME'); ?></th>
						<th class="kcol-mid kbancreate"><?php echo JText::_('COM_KUNENA_BAN_CREATEDBY'); ?></th>
						<th class="kcol-last kbanmodify"><?php echo JText::_('COM_KUNENA_BAN_MODIFIEDBY'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					if ( !empty($this->banhistory) ) :
						foreach ($this->banhistory as $userban) :
				?>
				<tr class="krow1">
					<td class="kcol-first kid">
						<?php echo $j--; ?>
					</td>
					<td class="kcol-mid  kbanfrom">
						<span><?php echo $userban->blocked ? JText::_('COM_KUNENA_BAN_BANLEVEL_JOOMLA') : JText::_('COM_KUNENA_BAN_BANLEVEL_KUNENA') ?></span>
					</td>
					<td class="kcol-mid kbanstart">
						<span><?php  if( $userban->created_time ) echo KunenaDate::getInstance($userban->created_time)->toKunena('datetime'); ?></span>
					</td>
					<td class="kcol-mid kbanexpire">
						<span><?php echo $userban->isLifetime() ? JText::_('COM_KUNENA_BAN_LIFETIME') : KunenaDate::getInstance($userban->expiration)->toKunena('datetime'); ?></span>
					</td>
					<td class="kcol-mid kbancreate">
						<span><?php echo CKunenaLink::GetProfileLink ( intval($userban->created_by) ); ?></span>
					</td>
					<td class="kcol-last kbanmodify">
						<?php if ( $userban->modified_by && $userban->modified_time) { ?>
						<span>
							<?php echo CKunenaLink::GetProfileLink ( intval($userban->modified_by) ); ?>
							<?php echo KunenaDate::getInstance($userban->modified_time)->toKunena('datetime'); } ?>
						</span>
					</td>
				</tr>
				<?php if($userban->reason_public) : ?>
				<tr class="krow2">
					<td colspan="2" class="kcol-first kpublic-reason-label"><b><?php echo JText::_('COM_KUNENA_BAN_PUBLICREASON'); ?></b> :</td>
					<td colspan="4" class="kcol-mid  kpublic-reason-field"><?php echo KunenaHtmlParser::parseText ($userban->reason_public); ?></td>
				</tr>
				<?php endif; ?>
				<?php if($userban->reason_private) : ?>
				<tr class="krow2">
					<td colspan="2" class="kcol-first kprivate-reason-label"><b><?php echo JText::_('COM_KUNENA_BAN_PRIVATEREASON'); ?></b> :</td>
					<td colspan="4" class="kcol-mid kprivate-reason-field"><?php echo KunenaHtmlParser::parseText ($userban->reason_private); ?></td>
				</tr>
				<?php endif; ?>
				<?php if (is_array($userban->comments)) foreach ($userban->comments as $comment) : ?>
				<tr class="krow2">
					<td colspan="2" class="kcol-first kcommentby-label"><b><?php echo JText::sprintf('COM_KUNENA_BAN_COMMENT_BY', CKunenaLink::GetProfileLink ( intval($comment->userid) )); ?></b> :</td>
					<td colspan="1" class="kcol-mid kcommenttime-field"><?php echo KunenaDate::getInstance($comment->time)->toKunena(); ?></td>
					<td colspan="3" class="kcol-mid kcomment-field"><?php echo KunenaHtmlParser::parseText ($comment->comment); ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endforeach; ?>
				<?php else : ?>
				<tr class="krow1">
					<td colspan="6" class="kcol-first"><?php echo JText::sprintf('COM_KUNENA_BAN_USER_NOHISTORY', $this->escape($this->profile->name)); ?></td>
				</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
		<span class="corners-bottom"><span></span></span>
	</div>
</div>