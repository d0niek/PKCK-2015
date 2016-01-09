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
    protected function build()
    {
        $this
            ->addField('title')
            ->addField('performers', [
                'type' => self::FIELD_ENTITY
            ])
            ->addField('release', [
                'type' => self::FIELD_REGEXP,
                'pattern' => '/^[0-9]{4}\-[0,1][0-9]\-[0-3][0-9]$/',
            ])
            ->addField('ranking', [
                'type' => self::FIELD_REGEXP,
                'pattern' => '/^(10|[0-9])\.[0,5]$/',
            ])
            ->addField('price', [
                'type' => self::FIELD_REGEXP,
                'pattern' => '/^[0-9]+\,[0-9]{2}$/',
            ]);

        for ($i = 0; $i < 13; $i++) {
            $this
                ->addField('track_' . $i, [
                    'required' => false,
                ])
                ->addField('track_length_' . $i, [
                    'type' => self::FIELD_REGEXP,
                    'required' => false,
                    'pattern' => '/^[0-9]{2}\:[0-5][0-9]\:[0-5][0-9]$/',
                ]);
        }
    }
}
