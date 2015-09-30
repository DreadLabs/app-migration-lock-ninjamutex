<?php

/*
 * This file is part of the AppMigration\Lock\NinjaMutex package.
 *
 * (c) Thomas Juhnke <dev@van-tomas.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreadLabs\AppMigration\Lock\NinjaMutex\Tests\Unit;

use DreadLabs\AppMigration\Exception\LockingException;
use DreadLabs\AppMigration\Lock\NinjaMutex\Lock;
use DreadLabs\AppMigration\Lock\NinjaMutex\NameInterface;
use DreadLabs\AppMigration\Lock\NinjaMutex\TimeoutInterface;
use NinjaMutex\Lock\LockInterface;

/**
 * LockTest
 *
 * @author Thomas Juhnke <dev@van-tomas.de>
 */
class LockTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var LockInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $backend;

    /**
     * @var NameInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $name;

    /**
     * @var \DreadLabs\AppMigration\Lock\NinjaMutex\TimeoutInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $timeout;

    public function setUp()
    {
        $this->backend = $this->getMock(LockInterface::class, array('acquireLock', 'releaseLock', 'isLocked'));
        $this->name = $this->getMock(NameInterface::class, array('__toString'));
        $this->timeout = $this->getMock(TimeoutInterface::class, array('getValue'));

        $this->name->expects($this->any())->method('__toString')->willReturn('test-lock');
    }

    public function testItThrowsALockingExceptionIfLockCantBeAcquired()
    {
        $this->setExpectedException(LockingException::class);

        $this->backend->expects($this->once())->method('acquireLock')->with('test-lock', 42)->willReturn(false);
        $this->backend->expects($this->never())->method('releaseLock');

        $this->timeout->expects($this->any())->method('getValue')->willReturn(42);

        $lock = new Lock($this->backend, $this->name, $this->timeout);
        $lock->acquire();
    }

    public function testItAcquiresLockingOnTheLock()
    {
        $this->backend->expects($this->once())->method('acquireLock')->with('test-lock', 42)->willReturn(true);
        $this->backend->expects($this->once())->method('releaseLock')->willReturn(true);

        $this->timeout->expects($this->any())->method('getValue')->willReturn(42);

        $lock = new Lock($this->backend, $this->name, $this->timeout);
        $lock->acquire();
    }

    public function testItReleasesLockingOnTheLock()
    {
        $this->backend->expects($this->once())->method('acquireLock')->with('test-lock', 23)->willReturn(true);
        $this->backend->expects($this->once())->method('releaseLock')->with('test-lock')->willReturn(true);

        $this->timeout->expects($this->any())->method('getValue')->willReturn(23);

        $lock = new Lock($this->backend, $this->name, $this->timeout);
        $lock->acquire();
        $lock->release();
    }
}
