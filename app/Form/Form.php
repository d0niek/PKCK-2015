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

    /** @var array $fields */
    private $fields = [];

    /** @var \Entity\Collection $collection */
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;

        $this->build();
    }

    /**
     * Validate form
     *
     * @param array $post
     *
     * @return bool
     * @throws \Exception
     */
    public function valid(array &$post)
    {
        foreach ($this->fields as $field => &$options) {
            try {
                $post[$field] = isset($post[$field]) ? $post[$field] : '';

                $post[$field] = trim($post[$field]);
                $post[$field] = preg_replace('/[\ ]{2,}/', ' ', $post[$field]);

                $options['value'] = $post[$field];

                $this->validField($post[$field], $field, $options);
            } catch (Exception $e) {
                if (!isset($_SESSION['validMessage'])) {
                    $_SESSION['validMessage'] = $e->getMessage();
                }
            }
        }

        return !isset($_SESSION['validMessage']);
    }

    /**
     * Validate form value
     *
     * @param mixed $fieldValue
     * @param string $fieldName
     * @param array $options
     *
     * @throws \Exception
     */
    private function validField($fieldValue, $fieldName, array $options)
    {
        if (empty($fieldValue)) {
            if ($options['required'] === true) {
                throw new Exception('Required field "' . $fieldName . '" is empty');
            }

            return;
        }

        switch ($options['type']) {
            case self::FIELD_SIMPLE:
                break;

            case self::FIELD_REGEXP:
                if (!preg_match($options['pattern'], $fieldValue)) {
                    throw new Exception('Field "' . $fieldName . '" has wrong format');
                }
                break;

            case self::FIELD_ENTITY:
                $method = 'find' . $options['entity'] . 'ById';

                $this->collection->$method($fieldValue);
                break;
        }
    }

    /**
     * Builds form
     */
    abstract protected function build();

    /**
     * Adds field to list
     *
     * @param string $fieldName
     * @param array $options
     *
     * @return $this
     * @throws \Exception
     */
    protected function addField($fieldName, array $options = [])
    {
        if (isset($this->fields[$fieldName])) {
            throw new Exception('Duplicate field "' . $fieldName . '" in form ' . get_class($this));
        }

        if (!isset($options['type'])) {
            $options['type'] = self::FIELD_SIMPLE;
        }

        if (!isset($options['required'])) {
            $options['required'] = true;
        }

        if ($options['type'] === self::FIELD_REGEXP && !isset($options['pattern'])) {
            throw new Exception('Field "' . $fieldName . '" is regexp type but dose not have pattern');
        }

        if ($options['type'] === self::FIELD_ENTITY) {
            if (!isset($options['entity'])) {
                throw new Exception('Field "' . $fieldName . '" dose not have assigned entity');
            }

            if ($options['entity'] !== 'Record' && $options['entity'] !== 'Performer') {
                throw new Exception('Unknown entity type ' . $options['entity']);
            }
        }

        $options['value'] = '';

        $this->fields[$fieldName] = $options;

        return $this;
    }

    #region Getters

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Gets field from form
     *
     * @param string $field
     *
     * @return array
     * @throws \Exception
     */
    public function getField($field)
    {
        if (isset($this->fields[$field])) {
            return $this->fields[$field];
        }

        throw new Exception('Can not find field "' . $field . '" in form ' . get_class($this));
    }

    #endregion
}
