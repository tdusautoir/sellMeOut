<?php

//Constants
const FLASH = 'FLASH_MESSAGES';

//flash type
const FLASH_ERROR = 'error';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

function dump($var) //function for debug
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

function init_php_session(): bool //init php session
{
    if (!session_id()) {
        session_start();
        session_regenerate_id();
        return true;
    }
    return false;
}

function clean_php_session(): void //clean the php session
{
    session_unset();
    session_destroy();
}

function is_logged(): bool
{
    if (isset($_SESSION["profile"])) {
        return true;
    }
    return false;
}

//create a flash message
function create_flash_message(string $name, string $message, string $type): void
{
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

//check if flash message is define by name
function isset_flash_message_by_name(string $name): bool
{
    if (isset($_SESSION[FLASH][$name])) {
        return true;
    } else {
        return false;
    }
}

//check if flash message is define by type
function isset_flash_message_by_type(string $type): bool
{
    if (isset($_SESSION[FLASH])) {
        foreach ($_SESSION[FLASH] as $key => $value) {
            if ($value['type'] == $type) {
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}

//Delete flash message by name
function delete_flash_message_by_name(string $name): bool
{
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    } else {
        return false;
    }
}


//delete flash message by type
function delete_flash_message_by_type(string $type): bool
{
    if (isset($_SESSION[FLASH])) {
        foreach ($_SESSION[FLASH] as $key => $value) {
            if ($value['type'] == $type) {
                unset($_SESSION[FLASH][$key]);
            } else {
                return false;
            }
        }
    }
    return false;
}

//Display flash message by type
function display_flash_message_by_name(string $name): void
{
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }
    $flash_message[$name] = $_SESSION[FLASH][$name];
    unset($_SESSION[FLASH][$name]);


    echo $flash_message[$name]['message'];
}


//Display flash message by type
function display_flash_message_by_type(string $type): void
{
    if (isset($_SESSION[FLASH])) {
        foreach ($_SESSION[FLASH] as $key => $value) {
            if ($value['type'] == $type) {

                $flash_message = $value['message'];
                unset($_SESSION[FLASH][$key]);
                echo $flash_message;
            }
        }
    }
}