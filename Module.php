<?php
/**
 * Prime Rates (http://www.primerates.com/)
 *
 * @link      http://www.primerates.com/
 * @copyright Copyright (c) 2012 Skygate - the winged software house (http://www.skygate.pl)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SkyContent;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sharedEvents = $eventManager->getSharedManager();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/Content/',
                ),
            ),
        );
    }
}
