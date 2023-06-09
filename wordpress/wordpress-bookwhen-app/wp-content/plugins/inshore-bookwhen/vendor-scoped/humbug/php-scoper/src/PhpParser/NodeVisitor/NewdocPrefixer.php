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
namespace _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\NodeVisitor;

use _PhpScoper6af4d594edb1\Humbug\PhpScoper\PhpParser\StringNodePrefixer;
use _PhpScoper6af4d594edb1\PhpParser\Node;
use _PhpScoper6af4d594edb1\PhpParser\Node\Scalar\String_;
use _PhpScoper6af4d594edb1\PhpParser\NodeVisitorAbstract;
use function ltrim;
use function str_starts_with;
use function substr;
final class NewdocPrefixer extends NodeVisitorAbstract
{
    public function __construct(private readonly StringNodePrefixer $stringPrefixer)
    {
    }
    public function enterNode(Node $node) : Node
    {
        if ($node instanceof String_ && $this->isPhpNowdoc($node)) {
            $this->stringPrefixer->prefixStringValue($node);
        }
        return $node;
    }
    private function isPhpNowdoc(String_ $node) : bool
    {
        if (String_::KIND_NOWDOC !== $node->getAttribute('kind')) {
            return \false;
        }
        return str_starts_with(substr(ltrim($node->value), 0, 5), '<?php');
    }
}
