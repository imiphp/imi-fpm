<?php

declare(strict_types=1);

namespace Imi\Fpm\Server\Http\Listener;

use Imi\App;
use Imi\Config;
use Imi\Event\CommonEvent;
use Imi\Event\IEventListener;
use Imi\Fpm\Server\Type;
use Imi\Server\Http\Listener\HttpRouteInit;
use Imi\Server\Http\Route\HttpRoute;
use Imi\Server\ServerManager;

class BuildRuntimeListener implements IEventListener
{
    /**
     * @param \Imi\Core\Runtime\Event\BuildRuntimeInfoEvent $e
     */
    public function handle(\Imi\Event\Contract\IEvent $e): void
    {
        if (!Config::get('@app.imi.runtime.route', true))
        {
            return;
        }

        if ('cli' === \PHP_SAPI)
        {
            Config::addConfig('@server.main', Config::get('@app'));
            $server = ServerManager::createServer('main', [
                'type'      => Type::HTTP,
                'namespace' => App::getNamespace(),
            ]);
            /** @var HttpRoute $route */
            $route = $server->getBean('HttpRoute');
            (new HttpRouteInit())->handle(new CommonEvent(''));
            $e->data['route']['rules'] = $route->getRules();
        }
    }
}
