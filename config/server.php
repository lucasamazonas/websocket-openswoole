<?php

declare(strict_types=1);

return [
    // Process
    'pid_file' => __DIR__ . '/../var/server.pid',

    // Logging
    'log_level' => $_ENV['APP_MODE'] === 'production'
        ? OpenSwoole\Constant::LOG_ERROR : OpenSwoole\Constant::LOG_INFO,
    'log_file' => __DIR__ . '/../var/openswoole.log',
    'log_rotation' => OpenSwoole\Constant::LOG_ROTATION_DAILY,
    'log_date_format' => '%Y-%m-%d %H:%M:%S',
];