<?php

/*
 * This file is part of the AppMigrationLock\NinjaMutex package.
 *
 * (c) Thomas Juhnke <dev@van-tomas.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreadLabs\AppMigrationLock\NinjaMutex\Timeout;

use DreadLabs\AppMigrationLock\NinjaMutex\TimeoutInterface;

/**
 * Blocking
 *
 * Enables blocking for the selected lock implementation.
 *
 * @author Thomas Juhnke <dev@van-tomas.de>
 */
class Blocking implements TimeoutInterface
{

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return null;
    }
}
