<?php

return [
    'namespace' => 'App\\Http\\Controllers',
    'files' => [
        realpath(__DIR__.'/../../routes/web.php'),
        realpath(__DIR__.'/../../routes/api.php')
    ]
];