<?php

/*
 * This file is part of the AppMigrationLock\NinjaMutex package.
 *
 * (c) Thomas Juhnke <dev@van-tomas.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreadLabs\AppMigration\Lock\NinjaMutex\Tests\Unit\Timeout;

use DreadLabs\AppMigration\Lock\NinjaMutex\Timeout\Immediate;

/**
 * ImmediateTest
 *
 * @author Thomas Juhnke <dev@van-tomas.de>
 */
class ImmediateTest extends \PHPUnit_Framework_TestCase
{

    public function testItReturnsZero()
    {
        $immediateTimeout = new Immediate();
        $this->assertSame(0, $immediateTimeout->getValue());
    }
}
