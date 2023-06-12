<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit;

use App\Entity\Shipping\ShippingMethod;
use Asdoria\SyliusShippingDeliveryTimePlugin\Entity\ShippingSchedule;
use Asdoria\SyliusShippingDeliveryTimePlugin\Factory\ShippingScheduleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ShippingScheduleTest
 *
 * @package Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit
 *
 */
class ShippingScheduleTest extends TestCase
{
    public function testCanBeCreated(): ShippingSchedule
    {
        $shippingSchedule = new ShippingSchedule();
        $shippingSchedule->setCode('shipping_schedule_1');

        $this->assertSame('shipping_schedule_1', $shippingSchedule->getCode());
        $this->assertInstanceOf(ShippingSchedule::class, $shippingSchedule);

        return $shippingSchedule;
    }

    public function testCanBeCreatedForShippingMethod(): ShippingSchedule
    {
        $shippingMethod = new ShippingMethod();
        $shippingMethod->setCode('shipping_method_1');

        $shippingScheduleFactory = new ShippingScheduleFactory(ShippingSchedule::class);
        $shippingSchedule = $shippingScheduleFactory->createForShippingMethod($shippingMethod);
        $shippingSchedule->setCode('shipping_schedule_1');

        $this->assertInstanceOf(ShippingMethod::class, $shippingSchedule->getShippingMethod());

        return $shippingSchedule;
    }

    /**
     * @depends testCanBeCreated
     */
    public function testShippingMethod(ShippingSchedule $shippingSchedule)
    {
        $shippingMethod = new ShippingMethod();
        $shippingMethod->setCode('shipping_method_2');

        $shippingSchedule->setShippingMethod($shippingMethod);
        $shippingScheduleShippingMethod = $shippingSchedule->getShippingMethod();

        $this->assertInstanceOf(ShippingMethod::class, $shippingScheduleShippingMethod);
    }

    /**
     * @depends testCanBeCreated
     */
    public function testShipAt(ShippingSchedule $shippingSchedule)
    {
        $now = new \DateTime('now');

        $shippingSchedule->setShipAt($now);
        $this->assertEquals($now, $shippingSchedule->getShipAt());
    }

    /**
     * @depends testCanBeCreated
     */
    public function testStartsAt(ShippingSchedule $shippingSchedule)
    {
        $now = new \DateTime('now');

        $shippingSchedule->setStartsAt($now);
        $this->assertEquals($now, $shippingSchedule->getStartsAt());
    }

    /**
     * @depends testCanBeCreated
     */
    public function testEndsAt(ShippingSchedule $shippingSchedule)
    {
        $now = new \DateTime('now');

        $shippingSchedule->setEndsAt($now);
        $this->assertEquals($now, $shippingSchedule->getEndsAt());
    }
}
