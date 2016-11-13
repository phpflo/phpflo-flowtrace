<?php
/*
 * This file is part of the phpflo/phpflo-flowtrace package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpFlo\Common;

/**
 * Class AbstractNetworkAdapter
 *
 * @package PhpFlo\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class AbstractNetworkAdapter
{
    /**
     * @var NetworkInterface
     */
    protected $network;

    /**
     * AbstractNetworkAdapter constructor.
     *
     * @param NetworkInterface $network
     */
    public function __construct(NetworkInterface $network)
    {
        $this->network = $network;
    }

    /**
     * @return NetworkInterface
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * @return null|Graph
     */
    public function getGraph()
    {
        return $this->network->getGraph();
    }

    /**
     * Cleanup network state after runs.
     *
     * @return $this
     */
    public function shutdown()
    {
        $this->network->shutdown();

        return $this;
    }
}
