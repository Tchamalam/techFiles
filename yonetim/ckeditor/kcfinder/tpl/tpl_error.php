<root>
<?php IF (is_array($message)): ?>
<?php   FOREACH ($message as $msg): ?>
<error><?php echo text::xmlData($msg) ?></error>
<?php   ENDFOREACH ?>
<?php ELSE: ?>
<error><?php echo text::xmlData($message) ?></error>
<?php ENDIF ?>
</root>
