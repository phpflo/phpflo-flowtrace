<?php
/*
 * This file is part of the phpflo/phpflo-flowtrace package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpFlo;

use PhpFlo\Common\AbstractNetworkAdapter;
use PhpFlo\Common\NetworkAdapterinterface;
use PhpFlo\Common\NetworkInterface;
use PhpFlo\Exception\InvalidDefinitionException;

/**
 * Network for tracing events.
 *
 * @package PhpFlo
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class TraceableNetwork extends AbstractNetworkAdapter implements NetworkAdapterinterface, NetworkInterface
{
    /**
     * @param mixed $data
     * @param string $node
     * @param string $port
     * @return $this
     * @throws InvalidDefinitionException
     */
    public function addInitial($data, $node, $port)
    {
        $this->network->addInitial($data, $node, $port);

        return $this;
    }
}
