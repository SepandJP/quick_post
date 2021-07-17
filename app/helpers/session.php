<?php

session_start();

/**
 * Shows message when the request of the user is complete.
 * for example: When a user registered, show a message that register is successful
 *
 * @param string $name The name of SESSION
 * @param string $message The message that shows for the user.
 * @param string $class BootStrap class name that uses in the message section.
 */
function flashMessages ($name='', $message='', $class='alert alert-success')
{
    // made sure of $name parameter, not empty
    if (!empty($name))
    {
        // SESSION doesn't exist but a message is exist.
        if (!empty($message) && empty($_SESSION[$name]))
        {
            // If SESSION exists since before.
            if (!empty($_SESSION[$name]))
            {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class']))
            {
                unset($_SESSION[$name . '_class']);
            }

            // Create SESSION data
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        }

        // When calling the FLASH function with the SESSION's name parameter, execute this
        elseif (empty($message) && !empty($_SESSION[$name]))
        {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="'. $class .'" id="flashMessage">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$$name . '_class']);
        }
    }
}