<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/9/16
 * Time: 3:05 PM
 */

namespace Form;

use Entity\Collection;
use Exception;

abstract class Form
{
    const FIELD_SIMPLE = 'simple';
    const FIELD_REGEXP = 'regexp';
    const FIELD_ENTITY = 'entity';
    const FIELDS = [];

    /** @var \Entity\Collection $collection */
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Validate form
     *
     * @param array $post
     *
     * @return bool
     * @throws \Exception
     */
    public function validForm(array &$post)
    {
        foreach ($this::FIELDS as $field => $value) {
            if (!array_key_exists($field, $post)) {
                throw new Exception('Form dose not have field "' . $field . '"');
            }

            $post[$field] = trim($post[$field]);
            $post[$field] = preg_replace('/[\ ]{2,}/', ' ', $post[$field]);

            $this->validField($post[$field], $field, $value);
        }

        return true;
    }

    /**
     * Validate form value
     *
     * @param mixed $fieldValue
     * @param string $fieldName
     * @param array $validInformation
     *
     * @throws \Exception
     */
    private function validField($fieldValue, $fieldName, array $validInformation)
    {
        if (empty($fieldValue)) {
            if ($validInformation['required'] === true) {
                throw new Exception('Required field "' . $fieldName . '" is empty');
            }

            return;
        }

        switch ($validInformation['type']) {
            case self::FIELD_SIMPLE:
                break;

            case self::FIELD_REGEXP:
                if (!preg_match($validInformation['pattern'], $fieldValue)) {
                    throw new Exception('Field "' . $fieldName . '" has wrong format');
                }
                break;

            case self::FIELD_ENTITY:
                $this->collection->findPerformerById($fieldValue);
                break;
        }
    }
}
