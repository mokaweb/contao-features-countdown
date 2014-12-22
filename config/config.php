<?php

// {{meintag::Hallo das ist mein Tag}}

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('Countdown', 'ersetze_meintag');

?>
