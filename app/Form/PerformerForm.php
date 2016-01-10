<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/10/16
 * Time: 5:36 PM
 */

namespace Form;

class PerformerForm extends Form
{
    /**
     * Builds form
     */
    protected function build()
    {
        $this
            ->addField('name')
            ->addField('type', [
                'type' => self::FIELD_REGEXP,
                'pattern' => '(metal|rock|rap|hip-hop|drum-and-bass|disco-polo|art-pop|sludge|indie)'
            ])
            ->addField('members', [
                'type' => self::FIELD_NUMBER,
            ]);
    }
}
