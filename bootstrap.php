<?php

if (!file_exists( __DIR__  . '/config/settings.php' ))
    die('Unable to include /config/settings.php');

/**
 * require settings
 */
$settings = include __DIR__ . '/config/settings.php';

/**
 * require Request class
 */
require_once __DIR__ . '/src/Request.php';

/**
 * require Cache class
 */
require_once __DIR__ . '/src/Cache.php';

/**
 * require View class
 */
require_once __DIR__ . '/src/View.php';

/**
 * require vk.com API class
 */
require_once __DIR__ . '/src/VkAction.php';