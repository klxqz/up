<?php

return array(
    'name' => 'Вверх',
    'description' => 'Быстрая прокрутка вверх страницы',
    'vendor'=>903438,
    'version'=>'1.0.0',
    'img'=>'img/up.png',
    'frontend'    => true,
    'shop_settings' => true,
    'icons'=>array(
        16=>'img/up.png',
    ),
    'handlers' => array(
        'frontend_footer' => 'frontendFooter',
    ),

);
//EOF
