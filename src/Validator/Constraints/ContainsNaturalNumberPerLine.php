<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsNaturalNumberPerLine extends Constraint
{
    public $message = "\"value\" nie jest liczbą naturalną z zakresu [1, 99999].";
}