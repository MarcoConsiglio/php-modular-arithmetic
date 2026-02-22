<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector;
use Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector;
use Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector;
use Rector\Php84\Rector\MethodCall\NewMethodCallWithoutParenthesesRector;

$level = 36;
return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets()
    ->withComposerBased(phpunit: true)
    ->withTypeCoverageLevel($level)
    ->withDeadCodeLevel($level)
    ->withCodeQualityLevel($level)
    ->withSkip([
        NewMethodCallWithoutParenthesesRector::class => [__DIR__ . '/tests'],
        RemoveDeadZeroAndOneOperationRector::class => [__DIR__ . '/tests'],
        UseIdenticalOverEqualWithSameTypeRector::class,
        RemoveAlwaysTrueIfConditionRector::class => [__DIR__ . '/tests/BaseTestCase.php'],
        SimplifyMirrorAssignRector::class
    ]);
