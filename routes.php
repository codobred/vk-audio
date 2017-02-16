<?php

switch (Request::get('action')) {
    case 'search':
        $query = Request::get('query');

        if (!$query) {
            header('Location: /');
            die;
        }

        $vk = new VkAction(
            $settings['vk']['account'][0],
            $settings['vk']['account'][1]
        );

        echo View::make('layout', 'search', array(
            'query' => $query
        ));

        break;

    default:
        echo View::make('layout', 'index');
        break;
}
