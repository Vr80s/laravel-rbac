<?php
namespace Vr80s\LaravelRbac\Models;

use Vr80s\LaravelRbac\Models\NoValidationRulesFoundException;
use Vr80s\LaravelRbac\Models\NoValidatorInstantiatedException;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Entity extends Model
{
    protected $validationRules = [];
    protected $validator;
    protected $messages = [];
    protected $customAttributes = [];

    public function isValid()
    {
        if ( ! isset($this->validationRules)) {
            throw new NoValidationRulesFoundException('no validation rule array defined in class ' . get_called_class());
        }
//        $this->validator = Validator::make($this->getAttributes(), $this->getPreparedRules());
        $this->validator = Validator::make($this->getAttributes(),
            $this->getPreparedRules(),
            $this->getMessages(),
            $this->getCustomAttributes());

        return $this->validator->passes();
    }

    public function getErrors()
    {
        if ( ! $this->validator) {
            throw new NoValidatorInstantiatedException;
        }

        return $this->validator->errors();
    }

    public function save(array $options = [])
    {
        if ( ! $this->isValid()) {
            return false;
        }
        return parent::save($options);
    }

    protected function getPreparedRules()
    {
        return $this->replaceIdsIfExists($this->validationRules);
    }

    protected function replaceIdsIfExists($rules)
    {
        $newRules = [];

        foreach ($rules as $key => $rule) {
            if (str_contains($rule, '<id>')) {
                $replacement = $this->exists ? $this->getAttribute($this->primaryKey) : '';

                $rule = str_replace('<id>', $replacement, $rule);
            }

            array_set($newRules, $key, $rule);
        }

        return $newRules;
    }

    protected function getMessages(){
        return $this->messages;
    }

    protected function getCustomAttributes(){
        return $this->customAttributes;
    }
}