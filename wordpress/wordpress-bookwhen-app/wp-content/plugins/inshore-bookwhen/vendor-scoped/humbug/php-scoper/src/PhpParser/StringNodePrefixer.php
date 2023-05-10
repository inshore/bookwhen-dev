<?php

declare (strict_types=1);
/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser;

use _PhpScoper6af4d594edb1\Humbug\PhpScoper\Scoper\PhpScoper;
use _PhpScoper6af4d594edb1\PhpParser\Error as PhpParserError;
use _PhpScoper6af4d594edb1\PhpParser\Node\Scalar\String_;
use function substr;
/**
 * @private
 */
final class StringNodePrefixer
{
    public function __construct(private readonly PhpScoper $scoper)
    {
    }
    public function prefixStringValue(String_ $node) : void
    {
        try {
            $lastChar = substr($node->value, -1);
            $newValue = $this->scoper->scopePhp($node->value);
            if ("\n" !== $lastChar) {
                $newValue = substr($newValue, 0, -1);
            }
            $node->value = $newValue;
        } catch (PhpParserError $error) {
            // Continue without scoping the heredoc which for some reasons contains invalid PHP code
        }
    }
}
