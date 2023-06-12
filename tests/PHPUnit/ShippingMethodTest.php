<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit;

use App\Entity\Shipping\ShippingMethod;
use Asdoria\SyliusShippingDeliveryTimePlugin\Entity\ShippingSchedule;
use PHPUnit\Framework\TestCase;

/**
 * Class ShippingMethodTest
 *
 * @package Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit
 *
 */
class ShippingMethodTest extends TestCase
{

    public function testCanBeCreated(): ShippingMethod
    {
        $shippingMethod = new ShippingMethod();
        $shippingMethod->setCode('shipping_method_1');

        $this->assertSame('shipping_method_1', $shippingMethod->getCode());
        $this->assertInstanceOf(ShippingMethod::class, $shippingMethod);

        return $shippingMethod;
    }

    /**
     * @depends testCanBeCreated
     */
    public function testDeliveryMaxTime(ShippingMethod $shippingMethod)
    {
        $shippingMethod->setDeliveryMaxTime(1);
        $this->assertEquals(1, $shippingMethod->getDeliveryMaxTime());
    }

    /**
     * @depends testCanBeCreated
     */
    public function testDeliveryMinTime(ShippingMethod $shippingMethod)
    {
        $shippingMethod->setDeliveryMinTime(1);
        $this->assertEquals(1, $shippingMethod->getDeliveryMinTime());
    }

    /**
     * @depends testCanBeCreated
     */
    public function testShippingSchedules(ShippingMethod $shippingMethod)
    {
        $shippingSchedule = new ShippingSchedule();

        $shippingMethod->addShippingSchedule($shippingSchedule);
        $hasShippingSchedule = $shippingMethod->hasShippingSchedule($shippingSchedule);

        $this->assertTrue($hasShippingSchedule);
    }

   /**
     * @depends testCanBeCreated
     */
    public function testAdditionalDeliveryTime(ShippingMethod $shippingMethod)
    {
        $shippingMethod->setAdditionalDeliveryTime(array('FASHION_WEB' => array('day' => null)));
        $this->assertArrayHasKey('FASHION_WEB', $shippingMethod->getAdditionalDeliveryTime());
    }
}
