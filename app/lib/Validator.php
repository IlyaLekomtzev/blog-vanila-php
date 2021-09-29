<?php

namespace app\lib;

class Validator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * Производит валидацию по входным данным и правилам
     * @param $data
     * @param $rules
     * @return bool
     */
    public function make($data, $rules)
    {
        if (empty($data))
            return false;
        if (empty($rules))
            return true;

        foreach ($rules as $key => $item) {
            foreach ($item as $ruleKey => $rule){
                switch ($ruleKey) {
                    case 'required':
                        if ($rule && !$this->checkRequired($data[$key])) {
                            $this->setError($key, $ruleKey, 'Обязательное поле');
                        }
                        break;
                    case 'min':
                        if (!$this->checkMin($data[$key], $rule)) {
                            $this->setError($key, $ruleKey, 'Минимальное значение: '.$rule);
                        }
                        break;
                    case 'max':
                        if (!$this->checkMax($data[$key], $rule)) {
                            $this->setError($key, $ruleKey, 'Максимальное значение: '.$rule);
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Отдает массив ошибок
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Устанавливает ошибку
     * @param $item
     * @param $rule
     * @param $message
     */
    private function setError($item, $rule, $message)
    {
        $this->errors[$item][$rule] = [
            'key' => $item,
            'rule' => $rule,
            'message' => $message
        ];
    }

    /**
     * Проверяет на минимальное значение
     * @param $data
     * @param $value
     * @return bool
     */
    private function checkMin($data, $value)
    {
        $value = (int)$value;
        $type = gettype($data);

        if ($type === 'string') {
            if (mb_strlen($data) > $value) {
                return true;
            } else {
                return false;
            }
        } elseif ($type === 'integer') {
            if ((int)$data > $value) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Проверяет на максимальное значение
     * @param $data
     * @param $value
     * @return bool
     */
    private function checkMax($data, $value)
    {
        $value = (int)$value;
        $type = gettype($data);

        if ($type === 'string') {
            if (mb_strlen($data) <= $value) {
                return true;
            } else {
                return false;
            }
        } elseif ($type === 'integer') {
            if ((int)$data <= $value) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Проверяет на обязательность заполнения
     * @param $data
     * @return bool
     */
    private function checkRequired($data)
    {
        if (empty($data) || !isset($data)) {
            return false;
        } else {
            return true;
        }
    }
}