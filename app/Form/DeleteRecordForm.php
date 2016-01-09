<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/10/16
 * Time: 12:50 AM
 */

namespace Form;

class DeleteRecordForm extends Form
{
    /**
     * Builds form
     */
    protected function build()
    {
        $this
            ->addField('recordId', [
                'type' => self::FIELD_ENTITY,
                'required' => true,
            ]);
    }
}
