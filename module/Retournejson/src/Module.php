<?php
namespace Retournejson;

// Add these import statements:
use Zend\Db\Adapter\AdapterInterface;
//use Zend\Db\ResultSet\ResultSet;
//use Zend\Db\TableGateway\TableGateway;
//use Zend\ModuleManager\Feature\ConfigProviderInterface;

//class Module implements ConfigProviderInterface
//{
//    public function getConfig()
//    {
//        return include __DIR__ . '/../config/module.config.php';
//    }
//
//      
//    // Db Tools
//    public function getServiceConfig()
//    {
//        return [
//            'factories' => [
//                Model\StarshipTable::class => function($container) {
//                    $tableGateway = $container->get(Model\StarshipTableGateway::class);
//                    return new Model\StarshipTable($tableGateway);
//                },
//                Model\StarshipTableGateway::class => function ($container) {
//                    $dbAdapter = $container->get(AdapterInterface::class);
//                    $resultSetPrototype = new ResultSet();
//                    $resultSetPrototype->setArrayObjectPrototype(new Model\Starship());
//                    return new TableGateway('starship', $dbAdapter, null, $resultSetPrototype);
//                },
//            ],
//        ];
//    }
//    
//    // DI
//    public function getControllerConfig()
//    {
//        return [
//            'factories' => [
//                Controller\RetournejsonController::class => function($container) {
//                    return new Controller\RetournejsonController(
//                        $container->get(Model\StarshipTable::class)
//                    );
//                },
//            ],
//        ];
//    }
//}

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
        // Add this method:
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\RetournejsonController::class => function($container) {
                    return new Controller\RetournejsonController(
                        $container->get(AdapterInterface::class)
                    );
                },
            ],
        ];
    }
}