<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\StubTests\TestData\Providers\Stubs;

use Generator;
use _PhpScoper6af4d594edb1\StubTests\TestData\Providers\PhpStormStubsSingleton;
class StubConstantsProvider
{
    public static function classConstantProvider() : ?Generator
    {
        $classesAndInterfaces = PhpStormStubsSingleton::getPhpStormStubs()->getClasses() + PhpStormStubsSingleton::getPhpStormStubs()->getInterfaces();
        foreach ($classesAndInterfaces as $class) {
            foreach ($class->constants as $constant) {
                (yield "constant {$class->sourceFilePath}/{$class->name}::{$constant->name}" => [$class, $constant]);
            }
        }
    }
    public static function globalConstantProvider() : ?Generator
    {
        foreach (PhpStormStubsSingleton::getPhpStormStubs()->getConstants() as $constantName => $constant) {
            (yield "constant {$constantName}" => [$constant]);
        }
    }
}
