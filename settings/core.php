<?php
session_start();

function ifLoggedIn()
{
    if (!($_SESSION['user_id'])) {
        header("Location: ../login/login_view.php");
        die();
    }
}

function getUserRole()
{
    if (!($_SESSION['user_role'])) {
        return false;
    } else {
        return $_SESSION['user_role'];
    }
}

function getUserID()
{
    if (!($_SESSION['user_id'])) {
        return false;
    } else {
        return $_SESSION['user_id'];
    }
}
