<?php

namespace Form;

class DeletePerformerForm extends Form
{
    /**
     * Builds form
     */
    protected function build()
    {
        $this
            ->addField('performerId', [
                'type' => self::FIELD_ENTITY,
                'entity' => 'Performer',
                'required' => true,
            ]);
    }
}
