<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit;

use App\Entity\Addressing\Zone;
use App\Entity\Channel\Channel;
use PHPUnit\Framework\TestCase;

/**
 * Class ChannelTest
 *
 * @package Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit
 *
 */
class ChannelTest extends TestCase
{

    public function testCanBeCreated(): Channel
    {
        $channel = new Channel();
        $channel->setCode('channel_1');

        $this->assertSame('channel_1', $channel->getCode());
        $this->assertInstanceOf(Channel::class, $channel);

        return $channel;
    }

    /**
     * @depends testCanBeCreated
     */
    public function testDefaultShippingZone(Channel $channel)
    {
        $zone = new Zone();
        $channel->setDefaultShippingZone($zone);

        $this->assertEquals($zone, $channel->getDefaultShippingZone());
    }
}
