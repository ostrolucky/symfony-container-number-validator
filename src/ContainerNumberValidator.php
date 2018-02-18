<?php

declare(strict_types=1);

namespace Ostrolucky\SymfonyContainerNumberValidator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContainerNumberValidator extends ConstraintValidator
{
    private const LETTER_MATRIX = [
        'A' => 10,
        'B' => 12,
        'C' => 13,
        'D' => 14,
        'E' => 15,
        'F' => 16,
        'G' => 17,
        'H' => 18,
        'I' => 19,
        'J' => 20,
        'K' => 21,
        'L' => 23,
        'M' => 24,
        'N' => 25,
        'O' => 26,
        'P' => 27,
        'Q' => 28,
        'R' => 29,
        'S' => 30,
        'T' => 31,
        'U' => 32,
        'V' => 34,
        'W' => 35,
        'X' => 36,
        'Y' => 37,
        'Z' => 38,
    ];

    private const LENGTH_WITHOUT_CHECK_DIGIT = 10;

    /**
     * {@inheritdoc}
     *
     * @param string $value
     */
    public function validate($value, Constraint $constraint): void
    {
        if ($value === null) {
            return;
        }

        if (!$constraint instanceof ContainerNumber) {
            throw new UnexpectedTypeException($constraint, ContainerNumber::class);
        }

        if (!isset($value[self::LENGTH_WITHOUT_CHECK_DIGIT])) {
            $this->context->buildViolation(ContainerNumber::MESSAGE_MISSING_CHECK_DIGIT)->addViolation();

            return;
        }

        if (!is_numeric($value[self::LENGTH_WITHOUT_CHECK_DIGIT])) {
            $this->context->buildViolation(ContainerNumber::MESSAGE_NON_NUMERIC_CHECK_DIGIT)->addViolation();

            return;
        }

        $checkDigit = (int)$value[self::LENGTH_WITHOUT_CHECK_DIGIT];

        $total = 0;
        for ($i = 0; $i < self::LENGTH_WITHOUT_CHECK_DIGIT; ++$i) {
            $currentCharacterValue = self::LETTER_MATRIX[$value[$i]] ?? $value[$i] ?? null;

            if (!is_numeric($currentCharacterValue)) {
                $this->context->buildViolation(ContainerNumber::MESSAGE_INVALID_CHARACTERS)->addViolation();

                return;
            }

            $total += $currentCharacterValue * (2 ** $i);
        }

        $checksum = $total - (int)($total / 11) * 11;

        if ($checkDigit !== ($checksum === 10 ? 0 : $checksum)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
