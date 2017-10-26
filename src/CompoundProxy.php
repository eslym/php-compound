<?php
/**
 * Created by PhpStorm.
 * User: engshun
 * Date: 10/26/17
 * Time: 9:35 PM
 */

namespace onepeople\utils;


class CompoundProxy extends Compound
{
    /**
     * @var Compound
     */
    private $__parent;

    /** @noinspection PhpMissingParentConstructorInspection */
    /**
     * @param $parent
     * @param $offset
     */
    public function __construct($parent, $offset)
    {
        $this->__parent = $parent;
        $this->__data = $offset;
    }

    public function set($value)
    {
        $internal = &$this->__parent->internalValue();
        if (!is_array($internal)) {
            $internal = [];
        }
        parent::set($value);
    }

    public function delete()
    {
        parent::delete();
        unset($this->__parent[$this->__data]);
    }

    public function isPresent()
    {
        return isset($this->__parent[$this->__data]);
    }

    public function getParent()
    {
        return $this->__parent;
    }

    protected function &internalValue()
    {
        return $this->__parent->internalValue()[$this->__data];
    }
}