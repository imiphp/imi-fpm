<?php

declare(strict_types=1);

return [
    // 项目根命名空间
    'namespace'         => 'Imi\Fpm\Test\Web',

    'debug'             => true,

    // 配置文件
    'configs'           => [
        'beans'        => __DIR__ . '/beans.php',
    ],

    // 扫描目录
    'beanScan'          => [
        'Imi\Fpm\Test\Web\Controller',
        'Imi\Fpm\Test\Web\Middleware',
        'Imi\Fpm\Test\Web\Error',
    ],

    // 组件命名空间
    'components'        => [
        'Fpm' => 'Imi\Fpm',
    ],

    'ignoreNamespace'   => [
        'Imi\Swoole\*',
        'Imi\Workerman\*',
        'Imi\Cron\*',
    ],

    'ignorePaths'       => [
        \dirname(__DIR__) . \DIRECTORY_SEPARATOR . 'public',
    ],

    // 日志配置
    'logger'            => [
        'channels' => [
            'imi' => [
                'handlers' => [
                    [
                        'class'     => \Monolog\Handler\RotatingFileHandler::class,
                        'construct' => [
                            'filename' => \dirname(__DIR__) . '/logs/log.log',
                        ],
                        'formatter' => [
                            'class'     => \Monolog\Formatter\LineFormatter::class,
                            'construct' => [
                                'dateFormat'                 => 'Y-m-d H:i:s',
                                'allowInlineLineBreaks'      => true,
                                'ignoreEmptyContextAndExtra' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    // 数据库配置
    'db'                => [
        // 默认连接池名
        'defaultPool'    => 'maindb',
    ],

    // redis 配置
    'redis'             => [
        // 默认连接池名
        'defaultPool'   => 'redis',
    ],

    // 锁
    'lock'              => [
        'list'  => [
            // 'atomic' =>  [
            //     'class' =>  'AtomicLock',
            //     'options'   =>  [
            //         'atomicName'    =>  'atomicLock',
            //     ],
            // ],
            'memoryTableLock'            => [
                'class'     => 'RedisLock',
                'options'   => [
                    'poolName'  => 'redis',
                ],
            ],
            'redisConnectionContextLock' => [
                'class'     => 'RedisLock',
                'options'   => [
                    'poolName'  => 'redis',
                ],
            ],
        ],
    ],

    // atmoic 配置
    'atomics'           => [
        'atomicLock'   => 1,
    ],

    'middleware'        => [
        'groups'    => [
            'test'  => [
                \Imi\Fpm\Test\Web\Middleware\Middleware4::class,
            ],
        ],
    ],
];
