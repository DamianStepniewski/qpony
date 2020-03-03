<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContainsNaturalNumberPerLineValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsNaturalNumberPerLine) {
            throw new UnexpectedTypeException($constraint, ContainsNaturalNumberPerLine::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        $lines = preg_split("/\r\n|\n|\r/", $value);
        foreach ($lines as $line) {
            if (!is_numeric($line) || intval($line) != $line || $line < 1 || $line > 99999) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('value', $line)
                    ->addViolation();
            }
        }
    }
}