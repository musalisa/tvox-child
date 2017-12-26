<?php
$tvox_current_child =  $GLOBALS['TVOX_CURRENT_CHILD'];
$tvox_child_layout =  $GLOBALS['TVOX_CHILD_LAYOUT'];

if ($tvox_child_layout != ''){
    get_template_part('footer-' . $tvox_current_child);
}
else {
    get_template_part('footer-storefront');
}
