<?php

declare(strict_types=1);

namespace Ostrolucky\SymfonyContainerValidator\Test;

use Ostrolucky\SymfonyContainerValidator\Container;
use Ostrolucky\SymfonyContainerValidator\ContainerValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ContainerValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @dataProvider correctContainerIds
     */
    public function testValidateCorrectContainers(string $containerId): void
    {
        $this->validator->validate($containerId, new Container());
        $this->assertNoViolation();
    }

    /**
     * @dataProvider incorrectContainerIds
     *
     * @param mixed $containerId
     */
    public function testValidateIncorrectContainers($containerId, string $message): void
    {
        $this->validator->validate($containerId, new Container());
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
            ['CSI', Container::MESSAGE_MISSING_CHECK_DIGIT],
            ['CSIU200082', Container::MESSAGE_MISSING_CHECK_DIGIT],
            ['CSIU200082A', Container::MESSAGE_NON_NUMERIC_CHECK_DIGIT],
            ['CSIU20 0820', Container::MESSAGE_INVALID_CHARACTERS],
            ['INXU6011677', Container::DEFAULT_MESSAGE],
        ];
    }

    protected function createValidator(): ContainerValidator
    {
        return new ContainerValidator();
    }
}
