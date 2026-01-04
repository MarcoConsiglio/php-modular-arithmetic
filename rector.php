<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

$level = 0;
return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withTypeCoverageLevel($level)
    ->withDeadCodeLevel($level)
    ->withCodeQualityLevel($level);
