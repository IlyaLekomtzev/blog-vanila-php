<?php

return [
    '' => [
        'method' => 'GET',
        'controller' => 'main',
        'action' => 'index'
    ],
    'add?{params:[?\w=&]+}' => [
        'method' => 'GET',
        'controller' => 'main',
        'action' => 'add'
    ],
    'add/submit' => [
        'method' => 'POST',
        'controller' => 'main',
        'action' => 'create'
    ],
    'edit/{id:\d+}' => [
        'method' => 'GET',
        'controller' => 'main',
        'action' => 'edit'
    ],
    'edit/submit' => [
        'method' => 'POST',
        'controller' => 'main',
        'action' => 'update'
    ],
    'delete/{id:\d+}' => [
        'method' => 'GET',
        'controller' => 'main',
        'action' => 'delete'
    ],
    'blog/{slug:[\w-]+}' => [
        'method' => 'GET',
        'controller' => 'main',
        'action' => 'detail'
    ],
];