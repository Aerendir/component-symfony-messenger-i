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

namespace SerendipityHQ\Component\Messenger\Finder;

use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use function Safe\sprintf;

final class DoctrineMessageFinder
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function exists(string $message, array $params = []): bool
    {
        $result = $this->find($message, $params);

        if (empty($result)) {
            return false;
        }

        // If used in a message handler, the message that is handling is still present in the database.
        // If it is still present in the database and we count === 0, then the conditions will always
        // been true and, in the end, we will lose the new message.
        // Accpting that at least one message exists, we return false also if one message still exists.
        return (\is_countable($result) ? \count($result) : 0) > 1;
    }

    public function find(string $message, array $params = [])
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id', 'integer');
        $rsm->addScalarResult('body', 'body', 'json');
        $rsm->addScalarResult('headers', 'headers', 'json');
        $rsm->addScalarResult('queue_name', 'queue_name', 'string');
        $rsm->addScalarResult('created_at', 'created_at', 'string');
        $rsm->addScalarResult('available_at', 'available_at', 'string');
        $rsm->addScalarResult('delivered_at', 'delivered_at', 'string');

        $query = sprintf("SELECT * FROM messenger_messages WHERE headers::json->>'type' = '%s'", $message);

        foreach ($params as $param => $value) {
            $query .= sprintf(" AND body::json->>'%s' = '%s'", $param, $value);
        }

        try {
            $result = $this->entityManager->createNativeQuery($query, $rsm)->getResult();
        }
        // If no message has yet been dispatched, then the table "messenger_messages" doesn't exist
        catch (TableNotFoundException $tableNotFoundException) {
            return [];
        }

        if (false === \is_array($result)) {
            throw new \RuntimeException('The result is not an array but should.');
        }

        return $result;
    }
}
