<?php

/*
 * This file is part of the AppMigration\Lock\NinjaMutex package.
 *
 * (c) Thomas Juhnke <dev@van-tomas.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreadLabs\AppMigration\Lock\NinjaMutex;

/**
 * NameInterface
 *
 * The NinjaMutex Lock implementations need a name. This is
 * a wrapper around the scalar string type. Useful for
 * applications which does not support injecting scalar
 * arguments in their DICs.
 *
 * @author Thomas Juhnke <dev@van-tomas.de>
 */
interface NameInterface
{

    /**
     * @return string
     */
    public function __toString();
}
