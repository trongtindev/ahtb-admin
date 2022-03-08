<?php
function authentication()
{
    if (get_cookie('token') == '') {
        return null;
    }

    return 1;
}
