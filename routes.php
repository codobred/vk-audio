<?php

switch (Request::get('action')) {
    case 'search':
        echo View::make(false, 'index');
        break;
}