<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 4:43 PM
 */

return [
    [
        'route' => '',
        'controller' => 'Default',
        'action' => 'index',
    ],
    [
        'route' => 'add-record',
        'controller' => 'Record',
        'action' => 'add',
    ],
    [
        'route' => 'edit-record/{id}',
        'controller' => 'Record',
        'action' => 'edit',
    ],
    [
        'route' => 'delete-record/{id}',
        'controller' => 'Record',
        'action' => 'delete',
    ],
    [
        'route' => 'add-performer',
        'controller' => 'Performer',
        'action' => 'add',
    ],
    [
        'route' => 'edit-performer/{id}',
        'controller' => 'Performer',
        'action' => 'edit',
    ],
    [
        'route' => 'delete-performer/{id}',
        'controller' => 'Performer',
        'action' => 'delete',
    ],
];
