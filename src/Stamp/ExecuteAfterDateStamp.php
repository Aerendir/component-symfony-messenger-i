<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ Symfony Messenger Utils Component.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Component\Messenger\Stamp;

use Symfony\Component\Messenger\Stamp\DelayStamp;

/**
 * Creates a DelayStamp starting from a date in the future.
 */
final class ExecuteAfterDateStamp
{
    /**
     * Disable instantiation.
     */
    private function __construct()
    {
    }

    public static function executeAfter(\DateTimeInterface $executeAfter): DelayStamp
    {
        $now  = (int) (new \DateTimeImmutable())->format('U');
        $diff = \abs((int) $executeAfter->format('U') - $now) * 1_000;

        return new DelayStamp($diff);
    }
}
