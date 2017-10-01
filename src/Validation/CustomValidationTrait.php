<?php

namespace Gotoeveryone\Validation;

/**
 * カスタムのバリデーション
 * バリデーションクラスに組み込んで利用します。
 */
trait CustomValidationTrait
{
    /**
     * マルチバイト文字への対応
     *
     * @static
     * @param $check
     */
    public static function alphaNumeric($check)
    {
        return (bool) preg_match('/^[a-zA-Z0-9\(\)\'\-\s]+$/', $check);
    }
}
