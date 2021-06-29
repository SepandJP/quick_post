<?php


/**
 * Redirect users to the defined page
 *
 * @param string $page
 */
function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}
