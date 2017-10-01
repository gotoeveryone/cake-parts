<?php

namespace Gotoeveryone\Validation;

/**
 * カスタムのバリデーション
 */
trait CustomValidationTrait
{
    /**
     * マルチバイト文字への対応
     *
     * @param $check
     */
    public function alphaNumeric($check)
    {
        return (bool) preg_match('/^[a-zA-Z0-9\(\)\'\-\s]+$/', $check);
    }
}
