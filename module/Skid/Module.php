<?php

namespace Skid;

use Zend\EventManager\EventInterface as Event;
use Zend\EventManager\EventManager;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Skid\Model\discountsModel;
use Zend\Session\Config\SessionConfig;
use Skid\Controller\SkidController;
 
class Module implements ServiceProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


    public function onBootstrap(Event $e)
    {
        // This method is called once the MVC bootstrapping is complete
        $application = $e->getApplication();
        $services    = $application->getServiceManager();


        $events = new EventManager();

        $events->attach('do', function($e) {

            $application = $e->getApplication();
            $services    = $application->getServiceManager();
//            echo 123;
//            exit;
          return $services; // $event = $e->getParams()['event'];

        });
//        print_r($services);
//        exit;
//        $config = new SessionConfig();
//        $config->setOptions(array(
//                                'remember_me_seconds' => 7200,
//                                'cookie_httponly' => true,
//                                'cache_expire' => 60,
//                                'cookie_lifetime'=>7200,
//                                'cookie_secure'=>true,
//                                'entropy_length' => 16,
//                                'gc_maxlifetime' => 65535,
//                                'gc_divisor' => 90,
//                                'gc_probability' => 1,
//                                'hash_bits_per_character' => 6,
//                                'use_cookies' => true,
//                            ));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {

        return array(
            'factories' => array(

                'Album\Model\AlbumTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table     = new discountsModel($dbAdapter);
                    return $table;
                },

            ),
        );
    }
}