<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsMaxTenLines extends Constraint
{
    public $message = "Nieprawidłowa ilość danych, podaj nie więcej niż 10 liczb, każda w nowej linii.";
}