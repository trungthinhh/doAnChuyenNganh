<?php

namespace libs\Html;

use libs\Css\AttributeHelper as CssAttributeHelper;
use libs\Html\AttributeInterface;
use libs\Helper\Characters;

class Attribute implements AttributeInterface {

    private $name;
    private $value;

    public function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function toString() {
        $value = $this->getValue();
        if (false === $value) {
            return '';
        }
        if (is_array($value)) {
            $helper = new CssAttributeHelper($value);
            $value = $helper->toString();
        }
        if(is_object($value) && get_class($value) === 'OCI-Lob'){
            $value = Characters::fromClob($value);
        }
        return $this->name . '="' . htmlspecialchars($value) . '"';
    }

}
