<?php

declare(strict_types=1);

namespace Ostrolucky\SymfonyContainerValidator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Container extends Constraint
{
    public const MESSAGE_MISSING_CHECK_DIGIT = 'Missing check digit, which should be 11th character';
    public const MESSAGE_NON_NUMERIC_CHECK_DIGIT = 'Check digit at 11th position must be numeric';
    public const MESSAGE_INVALID_CHARACTERS = 'There are invalid characters in container ID';

    public const DEFAULT_MESSAGE = 'This container ID is not valid';

    /**
     * @var string
     */
    public $message = self::DEFAULT_MESSAGE;
}
