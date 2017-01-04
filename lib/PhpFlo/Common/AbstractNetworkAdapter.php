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
abstract class AbstractNetworkAdapter implements NetworkInterface
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

    /**
     * Add a closure to an event
     *
     * Accepted events are connect, disconnect and data
     * Closures will be given the
     *
     * @param string $alias
     * @param string $event
     * @param \Closure $closure
     * @throws FlowException
     * @throws InvalidTypeException
     * @return $this
     */
    public function hook($alias, $event, \Closure $closure)
    {
        $this->network->hook($alias, $event, $closure);

        return $this;
    }

    /**
     * Get all defined custom event hooks
     *
     * @return array
     */
    public function hooks()
    {
        return $this->network->hooks();
    }

    /**
     * @return bool|\DateInterval
     */
    public function uptime()
    {
        return $this->network->uptime();
    }

    /**
     * @param array $node
     * @return $this
     * @throws \PhpFlo\Common\InvalidDefinitionException
     */
    public function addNode(array $node)
    {
        $this->network->addNode($node);

        return $this;
    }

    /**
     * @param array $node
     * @return $this
     */
    public function removeNode(array $node)
    {
        $this->network->removeNode($node);

        return $this;
    }

    /**
     * @param string $id
     * @return mixed|null
     */
    public function getNode($id)
    {
        return $this->network->getNode($id);
    }

    /**
     * @param array $edge
     * @return Network
     * @throws \PhpFlo\Common\InvalidDefinitionException
     */
    public function addEdge(array $edge)
    {
        $this->network->addEdge($edge);

        return $this;
    }

    /**
     * @param array $edge
     * @return $this
     */
    public function removeEdge(array $edge)
    {
        $this->network->removeEdge($edge);

        return $this;
    }

    /**
     * Add a flow definition as Graph object or definition file/string
     * and initialize the network processes/connections
     *
     * @param mixed $graph
     * @return Network
     * @throws \PhpFlo\Common\InvalidDefinitionException
     */
    public function boot($graph)
    {
        $this->network->boot($graph);

        return $this;
    }

    /**
     * @param mixed $data
     * @param string $node
     * @param string $port
     * @return $this
     */
    public function run($data, $node, $port)
    {
        $this->network->run($data, $node, $port);

        return $this;
    }
}
