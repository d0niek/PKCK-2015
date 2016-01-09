<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/9/16
 * Time: 3:07 PM
 */

namespace Form;

class RecordForm extends Form
{
    const FIELDS = [
        'title' => [
            'type' => self::FIELD_SIMPLE,
            'required' => true,
        ],
        'performers' => [
            'type' => self::FIELD_ENTITY,
            'required' => true,
        ],
        'release' => [
            'type' => self::FIELD_REGEXP,
            'required' => true,
            'pattern' => '/^[0-9]{4}\-[0,1][0-9]\-[0-3][0-9]$/',
        ],
        'ranking' => [
            'type' => self::FIELD_REGEXP,
            'required' => true,
            'pattern' => '/^(10|[0-9])\.[0,5]$/',
        ],
        'price' => [
            'type' => self::FIELD_REGEXP,
            'required' => true,
            'pattern' => '/^[0-9]+\,[0-9]{2}$/',
        ],
        'track_0' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
        ],
        'track_length_0' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_1' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
        ],
        'track_length_1' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_2' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_2' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_3' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_3' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_4' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_4' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_5' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_5' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_6' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_6' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_7' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_7' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_8' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_8' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_9' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_9' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_10' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_10' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_11' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_11' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_12' => [
            'type' => self::FIELD_SIMPLE,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
        'track_length_12' => [
            'type' => self::FIELD_REGEXP,
            'required' => false,
            'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
        ],
    ];
}
