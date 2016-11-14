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
            $this->stub('PhpFlo\Common\NetworkInterface')
        );
        $this->assertInstanceOf('PhpFlo\Common\NetworkInterface', $traceableNetwork->getNetwork());
    }

    public function testInterface()
    {
        //$this->markTestSkipped('Needs change in phpflo');
        $traceableNetwork = new TraceableNetwork(
            $this->stub(
                'PhpFlo\Common\NetworkInterface',
                [
                    'getGraph' => $this->stub('PhpFlo\Graph'),
                ]
            )
        );

        $this->assertInstanceOf('PhpFlo\Graph', $traceableNetwork->getGraph());
        $this->assertInstanceOf('PhpFlo\Common\NetworkAdapterInterface', $traceableNetwork->shutdown());
        $this->assertInstanceOf('PhpFlo\Common\NetworkAdapterInterface', $traceableNetwork->addInitial([], 'node', 'port'));

    }
}
