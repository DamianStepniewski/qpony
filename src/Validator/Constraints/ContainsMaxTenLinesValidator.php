<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContainsMaxTenLinesValidator extends ConstraintValidator
{

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsMaxTenLines) {
            throw new UnexpectedTypeException($constraint, ContainsMaxTenLines::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        $lines = preg_split("/\r\n|\n|\r/", $value);
        if (count($lines) > 10) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}