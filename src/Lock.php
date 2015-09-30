<?php

/*
 * This file is part of the AppMigrationLock\NinjaMutex package.
 *
 * (c) Thomas Juhnke <dev@van-tomas.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreadLabs\AppMigration\Lock\NinjaMutex;

use DreadLabs\AppMigration\Exception\LockingException;
use DreadLabs\AppMigration\LockInterface as LockAdapterInterface;
use DreadLabs\AppMigration\Lock\NinjaMutex\TimeoutInterface;
use NinjaMutex\Lock\LockInterface;
use NinjaMutex\Mutex;

/**
 * Lock
 *
 * Lock adapter around the NinjaMutex\Mutex to allow usage
 * within frameworks without proper DIC.
 *
 * @author Thomas Juhnke <dev@van-tomas.de>
 */
class Lock implements LockAdapterInterface
{

    /**
     * @var Mutex
     */
    private $lock;

    /**
     * @var TimeoutInterface
     */
    private $timeout;

    /**
     * Constructor
     *
     * @param LockInterface $backend
     * @param NameInterface $name
     * @param TimeoutInterface $timeout
     */
    public function __construct(LockInterface $backend, NameInterface $name, TimeoutInterface $timeout)
    {
        $this->lock = new Mutex((string) $name, $backend);
        $this->timeout = $timeout;
    }

    /**
     * @return void
     *
     * @throws LockingException If the lock is not acquirable
     */
    public function acquire()
    {
        $isAcquired = $this->lock->acquireLock($this->timeout->getValue());

        if (!$isAcquired) {
            throw new LockingException('Lock cannot be acquired.', 1438871269);
        }
    }

    /**
     * @return void
     */
    public function release()
    {
        $this->lock->releaseLock();
    }
}
