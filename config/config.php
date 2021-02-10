<?php

return [
    'mongodb' => [
        'host' => $_ENV['MONGODB_HOST'],
        'port' => $_ENV['MONGODB_PORT'],
        'username' => $_ENV['MONGODB_USERNAME'],
        'password' => $_ENV['MONGODB_PASSWORD'],
        'dbname' => $_ENV['MONGODB_DATABASE']
    ]
];
