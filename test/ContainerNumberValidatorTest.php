<?php

declare(strict_types=1);

namespace Ostrolucky\SymfonyContainerValidator\Test;

use Ostrolucky\SymfonyContainerNumberValidator\ContainerNumber;
use Ostrolucky\SymfonyContainerNumberValidator\ContainerNumberValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ContainerNumberValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @dataProvider correctContainerIds
     */
    public function testValidateCorrectContainers(string $containerId): void
    {
        $this->validator->validate($containerId, new ContainerNumber());
        $this->assertNoViolation();
    }

    /**
     * @dataProvider incorrectContainerIds
     *
     * @param mixed $containerId
     */
    public function testValidateIncorrectContainers($containerId, string $message): void
    {
        $this->validator->validate($containerId, new ContainerNumber());
        $this->buildViolation($message)->assertRaised();
    }

    /**
     * @return string[]
     */
    public function correctContainerIds(): array
    {
        return [
            ['CSIU2000820'],
            ['TRLU4284746'],
            ['MSKU6011672'],
        ];
    }

    /**
     * @return string[]
     */
    public function incorrectContainerIds(): array
    {
        return [
            ['CSI', ContainerNumber::MESSAGE_MISSING_CHECK_DIGIT],
            ['CSIU200082', ContainerNumber::MESSAGE_MISSING_CHECK_DIGIT],
            ['CSIU200082A', ContainerNumber::MESSAGE_NON_NUMERIC_CHECK_DIGIT],
            ['CSIU20 0820', ContainerNumber::MESSAGE_INVALID_CHARACTERS],
            ['INXU6011677', ContainerNumber::DEFAULT_MESSAGE],
        ];
    }

    protected function createValidator(): ContainerNumberValidator
    {
        return new ContainerNumberValidator();
    }
}
