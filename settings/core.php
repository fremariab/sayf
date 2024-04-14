<?php
session_start();

function ifLoggedIn()
{
    if (!($_SESSION['user_id'])) {
        header("Location: ../login/login_view.php");
        die();
    }
}

function getGender()
{
    if (!($_SESSION['gender'])) {
        return false;
    } else {
        return $_SESSION['gender'];
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
