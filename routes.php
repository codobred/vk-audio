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

        $tracks = $vk->audioSearch($query, 0, 30);

        echo View::make('layout', 'search', array(
            'query' => $query,
            'tracks' => $tracks,
        ));

        break;

    default:
        echo View::make('layout', 'index');
        break;
}
