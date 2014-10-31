<?php

return array(
    'name' => 'Вверх',
    'description' => 'Быстрая прокрутка вверх страницы',
    'vendor' => '985310',
    'version' => '1.0.3',
    'img' => 'img/up.png',
    'frontend' => true,
    'shop_settings' => true,
    'handlers' => array(
        'frontend_footer' => 'frontendFooter',
    ),
);
//EOF
