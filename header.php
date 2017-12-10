<?php
$tvox_current_child =  $GLOBALS['TVOX_CURRENT_CHILD'];

if ($tvox_current_child != ''){
    get_template_part('header-' . $tvox_current_child);
}
else {
    get_template_part('header-storefront');
}
