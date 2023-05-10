<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Monolog\Processor;

use _PhpScoper6af4d594edb1\Monolog\LogRecord;
/**
 * Injects memory_get_peak_usage in all records
 *
 * @see Monolog\Processor\MemoryProcessor::__construct() for options
 * @author Rob Jensen
 */
class MemoryPeakUsageProcessor extends MemoryProcessor
{
    /**
     * @inheritDoc
     */
    public function __invoke(LogRecord $record) : LogRecord
    {
        $usage = \memory_get_peak_usage($this->realUsage);
        if ($this->useFormatting) {
            $usage = $this->formatBytes($usage);
        }
        $record->extra['memory_peak_usage'] = $usage;
        return $record;
    }
}
