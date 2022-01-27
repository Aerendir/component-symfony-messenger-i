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

namespace SerendipityHQ\Component\Messenger\Message\Property;

trait Reschedulable
{
    private bool $reschedulable;

    public function isReschedulable(): bool
    {
        return $this->reschedulable;
    }

    public function setReschedulable(bool $reschedulable = true): void
    {
        $this->reschedulable = $reschedulable;
    }
}
