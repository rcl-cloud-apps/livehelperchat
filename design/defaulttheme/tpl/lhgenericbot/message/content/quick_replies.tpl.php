<div class="meta-message meta-message-<?php echo $messageId?>">
    <ul class="quick-replies list-inline meta-auto-hide">
    <?php foreach ($metaMessage as $item) : $disabledButton = isset($item['content']['disabled']) && $item['content']['disabled'] == true;?>
            <?php if ($item['type'] == 'url') : ?>
            <li class="list-inline-item">
                <a rel="noreferrer" <?php if (isset($item['content']['button_id']) && $item['content']['button_id'] != '') : ?>id="<?php echo htmlspecialchars($item['content']['button_id'])?>"<?php endif;?> <?php if (isset($item['content']['payload_message']) && $item['content']['payload_message'] != '') : ?>data-payload=<?php echo json_encode($item['content']['payload_message'])?> data-id="<?php echo $messageId?>" onclick='lhinst.buttonClicked(<?php echo json_encode($item['content']['payload_message'])?>,<?php echo $messageId?>,$(this))'<?php endif;?> class="btn btn-sm btn-outline-primary btn-bot" target="_blank" href="<?php echo htmlspecialchars($item['content']['payload'])?>"><i class="material-icons"><?php if (isset($react) && $react == true) : ?>&#xf106;<?php else : ?>open_in_new<?php endif; ?></i><?php echo htmlspecialchars($item['content']['name'])?></a>
            </li>
             <?php elseif ($item['type'] == 'trigger') : ?>
            <li class="list-inline-item"><button type="button" <?php if (isset($item['content']['button_id']) && $item['content']['button_id'] != '') : ?>id="<?php echo htmlspecialchars($item['content']['button_id'])?>"<?php endif;?> class="btn btn-sm btn-outline-primary btn-bot" <?php if ($disabledButton == true) : ?>disabled="disabled"<?php endif;?> <?php if ($disabledButton == false) : ?>data-payload=<?php echo json_encode($item['content']['payload']. '__' . md5($item['content']['name']))?> data-id="<?php echo $messageId?>" onclick='lhinst.updateTriggerClicked(<?php echo json_encode($item['content']['payload']. '__' . md5($item['content']['name']))?>,<?php echo $messageId?>,$(this))'<?php endif;?>><?php echo htmlspecialchars($item['content']['name'])?></button></li>
            <?php elseif ($item['type'] == 'updatechat') : ?>
                <?php if ($item['content']['payload'] == 'subscribeToNotifications') : $detectMobile = new Mobile_Detect; ?>
                    <?php if (!$detectMobile->is('IOS') && erLhcoreClassModelNotificationSubscriber::getCount(array('filter_custom' => array('`chat_id` = ' . (int)$chat->id . ($chat->online_user_id > 0 ? ' OR `online_user_id` = ' . (int)$chat->online_user_id : '')))) == 0) : ?>
                        <li class="list-inline-item"><button <?php if (isset($item['content']['button_id']) && $item['content']['button_id'] != '') : ?>id="<?php echo htmlspecialchars($item['content']['button_id'])?>"<?php endif;?> type="button" <?php if ($disabledButton == true) : ?>disabled="disabled"<?php endif;?> class="btn btn-sm btn-outline-primary btn-bot" <?php if ($disabledButton == false) : ?>data-id="<?php echo $messageId?>" onclick='$(this).attr("disabled","disabled").text("Subscribing...");notificationsLHC.sendNotification();'<?php endif;?>><?php echo htmlspecialchars($item['content']['name'])?></button></li>
                    <?php endif; ?>
                <?php else : ?>
                        <li class="list-inline-item"><button <?php if (isset($item['content']['button_id']) && $item['content']['button_id'] != '') : ?>id="<?php echo htmlspecialchars($item['content']['button_id'])?>"<?php endif;?> type="button" <?php if ($disabledButton == true) : ?>disabled="disabled"<?php endif;?> class="btn btn-sm btn-outline-primary btn-bot" <?php if ($disabledButton == false) : ?>data-payload=<?php echo json_encode($item['content']['payload'])?> data-id="<?php echo $messageId?>" onclick='lhinst.updateChatClicked(<?php echo json_encode($item['content']['payload'])?>,<?php echo $messageId?>,$(this))'<?php endif;?>><?php echo htmlspecialchars($item['content']['name'])?></button></li>
                <?php endif; ?>
            <?php else : ?>
                        <li class="list-inline-item"><button <?php if (isset($item['content']['button_id']) && $item['content']['button_id'] != '') : ?>id="<?php echo htmlspecialchars($item['content']['button_id'])?>"<?php endif;?> type="button" <?php if ($disabledButton == true) : ?>disabled="disabled"<?php endif;?> class="btn btn-sm btn-outline-primary btn-bot" <?php if ($disabledButton == false) : ?>data-payload=<?php echo json_encode($item['content']['payload']. '__' . md5($item['content']['name']))?> data-id="<?php echo $messageId?>" onclick='lhinst.buttonClicked(<?php echo json_encode($item['content']['payload']. '__' . md5($item['content']['name']))?>,<?php echo $messageId?>,$(this))'<?php endif;?>><?php echo htmlspecialchars($item['content']['name'])?></button></li>
            <?php endif?>
    <?php endforeach; ?>
    </ul>
</div>

