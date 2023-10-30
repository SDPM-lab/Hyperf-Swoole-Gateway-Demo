<?php

namespace App\JsonRpc;


use Hyperf\RpcClient\AbstractServiceClient;

class Product extends AbstractServiceClient implements ProductInterface
{
    protected string $serviceName = "ProducthService";
    protected string $protocol = "jsonrpc-http";

    public function products()
    {
        return $this->__request('index', []);
    }
}
