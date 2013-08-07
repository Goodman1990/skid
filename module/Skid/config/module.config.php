<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Skid\Controller\Skid' => 'Skid\Controller\SkidController',
            'Skid\Controller\Category' => 'Skid\Controller\CategoryController',
        ),
    ),
 
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(

            'skid' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/[:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]'
                    ),
                    'defaults' => array(
                        'controller' => 'Skid\Controller\Skid',
                        'action'     => 'index',
                    ),
                ),
            ),
            'category' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/category/[:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]'
                    ),
                    'defaults' => array(
                        'controller' => 'Skid\Controller\Category',
                        'action'     => 'index',
                    ),
                ),
            ),

        ),
    ),
 
    'view_manager' => array(
        'template_map' => array(

        ),
        'template_path_stack' => array(
            'skid' => __DIR__ . '/../view',
        ),
    ),

    
);