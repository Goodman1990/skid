<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Page\Controller\Page' => 'Page\Controller\PageController',
        ),
    ),
 
    // The following section is new and should be added to your file
    // 'router' => array(
    //     'routes' => array(
    //         'Page' => array(
    //             'type'    => 'segment',
    //             'options' => array(
    //                 'route'    => '/[:action][/:id]',
    //                 'constraints' => array(
    //                     'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
    //                     'id' => '[0-9]'
    //                 ),
    //                 'defaults' => array(
    //                     'controller' => 'Page\Controller\Page',
    //                     'action'     => 'index',
    //                 ),
    //             ),
    //         ),
    //     ),
    // ),
 
    'view_manager' => array(
        'template_map' => array(
            'header' => __DIR__ . '/../view/templates/header.phtml',
            'footer' => __DIR__ . '/../view/templates/footer.phtml',
            
        ),
        'template_path_stack' => array(
            'page' => __DIR__ . '/../view',
        ),
    ),

    
);