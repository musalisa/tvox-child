<?php
$tvox_current_child =  $GLOBALS['TVOX_CURRENT_CHILD'];

if ($tvox_current_child != ''){
    get_template_part('footer-' . $tvox_current_child);
}
else {
    get_template_part('footer-storefront');
}
