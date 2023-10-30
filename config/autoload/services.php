<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'consumers' => [
        [
            'name'          => 'ProducthService',
            'service'       => \App\JsonRpc\ProductInterface::class,
            'id'            => \App\JsonRpc\ProductInterface::class,
            'protocol'      => Hyperf\RpcMultiplex\Constant::PROTOCOL_DEFAULT,
            'load_balancer' => 'random',
            'registry'      => [
                'protocol' => 'consul',
                'address'  => 'http://10.1.1.7:8500',
            ],
            'options'       => [
                'connect_timeout' => 30.0,
                'recv_timeout' => 30.0,
                'settings'        => [
                    // 根据协议不同，区分配置
                    'open_eof_split' => true,
                    'package_eof'    => "\r\n",
                    // 'package_max_length' => 2 * 1024 * 1024,
                    // 'open_length_check' => true,
                    // 'package_length_type' => 'N',
                    // 'package_length_offset' => 0,
                    // 'package_body_offset' => 4,
                ],
                // // 重试次数，默认值为 2，收包超时不进行重试。暂只支持 JsonRpcPoolTransporter
                'retry_count'     => 2,
                'retry_interval'  => 100,
                'heartbeat'       => 30,
                // 'client_count' => 4,
                'pool'            => [
                    'min_connections' => 1,
                    'max_connections' => 600,
                    'connect_timeout' => 60.0,
                    'wait_timeout'    => 60.0,
                    'heartbeat'       => -1,
                    'max_idle_time'   => 60.0,
                ],
            ],
        ]
    ],
    'providers' => [],
    'drivers' => [
        'consul' => [
            'uri' => 'http://host.docker.internal:8500',
            'token' => '',
            'check' => [
                'deregister_critical_service_after' => '90m',
                'interval' => '5s',
            ],
        ],
        'nacos' => [
            // nacos server url like https://nacos.hyperf.io, Priority is higher than host:port
            // 'url' => '',
            // The nacos host info
            'host' => '127.0.0.1',
            'port' => 8848,
            // The nacos account info
            'username' => null,
            'password' => null,
            'guzzle' => [
                'config' => null,
            ],
            'group_name' => 'api',
            'namespace_id' => 'namespace_id',
            'heartbeat' => 5,
            'ephemeral' => false,
        ],
    ],
];
