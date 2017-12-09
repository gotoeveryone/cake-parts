<?php
/**
 * @since       0.0.5
 * @license     https://raw.githubusercontent.com/gotoeveryone/cake-parts/master/LICENSE MIT License
 */
namespace Gotoeveryone\Validation;

/**
 * Custom validation.
 */
trait CustomValidationTrait
{
    /**
     * Invalid multibyte value too.
     *
     * @static
     * @param mixed $check
     */
    public static function alphaNumeric($check)
    {
        return (bool) preg_match('/^[a-zA-Z0-9\(\)\'\-\s]+$/', $check);
    }
}
