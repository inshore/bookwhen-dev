<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Symfony\Component\HttpClient\Chunk;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @internal
 */
class FirstChunk extends DataChunk
{
    public function isFirst() : bool
    {
        return \true;
    }
}
