<?php

switch (Request::get('action')) {
    case 'search':
        die('make search');
        break;

    default:
        echo View::make('layout', 'index');
        break;
}