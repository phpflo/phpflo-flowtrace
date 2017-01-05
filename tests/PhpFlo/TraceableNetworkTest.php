<?php
/*
 * This file is part of the phpflo/phpflo-flowtrace package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\PhpFlo;

use PhpFlo\Test\TestUtilityTrait;
use PhpFlo\TraceableNetwork;

class TraceableNetworkTest extends \PHPUnit_Framework_TestCase
{
    use TestUtilityTrait;

    public function testInstance()
    {
        //$this->markTestSkipped('Needs change in phpflo');
        $traceableNetwork = new TraceableNetwork(
            $this->stub('PhpFlo\Common\NetworkInterface'),
            $this->stub('Psr\Log\LoggerInterface')
        );
        $this->assertInstanceOf('PhpFlo\Common\NetworkInterface', $traceableNetwork->getNetwork());
    }

    public function testInterface()
    {
        $network = $this->stub('PhpFlo\Common\NetworkInterface');
        $hookableNetwork = $this->stub(
            'PhpFlo\Common\NetworkInterface',
            [
                'getGraph' => $this->stub('PhpFlo\Graph'),
                'shutdown' => $network,
                'hook' => $network,
                'hooks' => [],
                'uptime' => new \DateInterval('P2Y4DT6H8M'),
                'addNode' => $network,
                'removeNode' => $network,
                'getNode' => [],
                'addEdge' => $network,
                'removeEdge' => $network,
                'boot' => $network,
                'run' => $network,
            ]
        );

        //$this->markTestSkipped('Needs change in phpflo');
        $traceableNetwork = new TraceableNetwork(
            $hookableNetwork,
            $this->stub('Psr\Log\LoggerInterface')
        );

        // adapter interface
        $this->assertInstanceOf('PhpFlo\Common\HookableNetworkInterface', $traceableNetwork->getNetwork());

        // network interface
        $this->assertInstanceOf('PhpFlo\Graph', $traceableNetwork->getGraph(), 'getGraph failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->shutdown(), 'shutdown failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->hook('data', 'test', function() {return true;}), 'hook failed');
        $this->assertTrue(is_array($traceableNetwork->hooks()), 'hooks failed');
        $this->assertInstanceOf('\Dateinterval', $traceableNetwork->uptime(), 'uptime failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->addNode([]), 'addNode failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->removeNode([]), 'removeNode failed');
        $this->assertTrue(is_array($traceableNetwork->getNode('id')), 'getNode failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->addEdge([]), 'addEdge failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->removeEdge([]), 'removeEdge failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->boot($this->stub('PhpFlo\Graph')), 'boot failed');
        $this->assertInstanceOf('PhpFlo\Common\NetworkDecoratorInterface', $traceableNetwork->run([], 'node', 'port'), 'run failed');
    }
}
