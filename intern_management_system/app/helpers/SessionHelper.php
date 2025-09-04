<?php

function redirect($page)
{
    header('Location: ' . BASE_URL . $page);
    exit;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function getUserRole()
{
    if (isset($_SESSION['role_name'])) {
        return $_SESSION['role_name'];
    }
    return null;
}

function isAdmin()
{
    return getUserRole() === 'Admin';
}

function isHR()
{
    return getUserRole() === 'HR';
}

function isCoordinator()
{
    return getUserRole() === 'Coordinator';
}

function isMentor()
{
    return getUserRole() === 'Mentor';
}

function isIntern()
{
    return getUserRole() === 'Intern';
}

function flash(string $name = '', string $message = '', string $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}