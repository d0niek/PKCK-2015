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
        'route' => 'add-author',
        'controller' => 'Author',
        'action' => 'add',
    ],
    [
        'route' => 'edit-author/{id}',
        'controller' => 'Author',
        'action' => 'edit',
    ],
    [
        'route' => 'delete-author/{id}',
        'controller' => 'Author',
        'action' => 'delete',
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
        'route' => 'add-track',
        'controller' => 'Track',
        'action' => 'add',
    ],
    [
        'route' => 'edit-track/{id}',
        'controller' => 'Track',
        'action' => 'edit',
    ],
    [
        'route' => 'delete-track/{id}',
        'controller' => 'Track',
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
