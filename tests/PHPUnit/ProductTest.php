<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit;

use App\Entity\Product\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductTest
 *
 * @package Tests\Asdoria\SyliusShippingDeliveryTimePlugin\PHPUnit
 *
 */
class ProductTest extends TestCase
{

    public function testCanBeCreated(): Product
    {
        $product = new Product();
        $product->setCode('product_1');

        $this->assertSame('product_1', $product->getCode());
        $this->assertInstanceOf(Product::class, $product);

        return $product;
    }

    /**
     * @depends testCanBeCreated
     */
    public function testAdditionalDeliveryTime(Product $product)
    {
        $product->setAdditionalDeliveryTime(2);
        $this->assertEquals(2, $product->getAdditionalDeliveryTime());
    }
}
