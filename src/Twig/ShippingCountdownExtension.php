<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Twig;

use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderItemUnit;
use App\Entity\Shipping\Shipment;
use Asdoria\SyliusShippingDeliveryTimePlugin\Entity\ShippingSchedule;
use Asdoria\SyliusShippingDeliveryTimePlugin\Helper\Model\ZoneHelperInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware\DefaultShippingZoneAwareInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware\ProductCountdownAwareInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Model\Aware\ShippingMethodCountdownAwareInterface;
use Asdoria\SyliusShippingDeliveryTimePlugin\Provider\NextShipmentDateTimeProviderInterface;
use DateTimeInterface;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\Address;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Core\Repository\ShippingMethodRepositoryInterface;
use Sylius\Component\Order\Context\CartContextInterface;
use Sylius\Component\Shipping\Resolver\ShippingMethodsResolverInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class ShippingCountdownExtension extends AbstractExtension
{
    private NextShipmentDateTimeProviderInterface $nextShipmentDateTimeProvider;

    protected ShippingMethodRepositoryInterface $methodRepository;

    protected ShippingMethodsResolverInterface $shippingMethodsResolver;

    protected CartContextInterface $contextCart;

    protected ChannelContextInterface $channelContext;

    protected ZoneHelperInterface $zoneHelper;

    const _DAYS_OF_WEEK
        = [
            ShippingSchedule::WEEKDAY_MONDAY,
            ShippingSchedule::WEEKDAY_TUESDAY,
            ShippingSchedule::WEEKDAY_WEDNESDAY,
            ShippingSchedule::WEEKDAY_THURSDAY,
            ShippingSchedule::WEEKDAY_FRIDAY,
            ShippingSchedule::WEEKDAY_SATURDAY,
            ShippingSchedule::WEEKDAY_SUNDAY
        ];

    /**
     * ShippingCountdownExtension constructor.
     *
     * @param NextShipmentDateTimeProviderInterface $nextShipmentDateTimeProvider
     * @param ShippingMethodRepositoryInterface     $methodRepository
     * @param ShippingMethodsResolverInterface      $shippingMethodsResolver
     * @param CartContextInterface                  $contextCart
     * @param ChannelContextInterface               $channelContext
     * @param ZoneHelperInterface                   $zoneHelper
     */
    public function __construct(
        NextShipmentDateTimeProviderInterface $nextShipmentDateTimeProvider,
        ShippingMethodRepositoryInterface $methodRepository,
        ShippingMethodsResolverInterface $shippingMethodsResolver,
        CartContextInterface $contextCart,
        ChannelContextInterface $channelContext,
        ZoneHelperInterface $zoneHelper
    )
    {
        $this->nextShipmentDateTimeProvider = $nextShipmentDateTimeProvider;
        $this->methodRepository             = $methodRepository;
        $this->shippingMethodsResolver      = $shippingMethodsResolver;
        $this->contextCart                  = $contextCart;
        $this->channelContext               = $channelContext;
        $this->zoneHelper                   = $zoneHelper;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('asdoria_shipping_delivery_time_next_shipment_date', [$this, 'nextShipmentDate']),
            new TwigFunction('asdoria_shipping_delivery_time_next_shipment_date_rfc2822', [$this, 'nextShipmentDateRFC2822']),
            //            new TwigFunction('asdoria_shipping_delivery_time_all_shipping_method', [$this, 'getAllShippingMethod']),
            new TwigFunction('asdoria_shipping_delivery_time_min_estimated_date_of_delivery', [$this, 'getMinDeliveryDateEstimate']),
            new TwigFunction('asdoria_shipping_delivery_time_max_estimated_date_of_delivery', [$this, 'getMaxDeliveryDateEstimate']),
            new TwigFunction('asdoria_shipping_delivery_time_support_methods', [$this, 'getSupportedMethods']),
            new TwigFunction('asdoria_shipping_delivery_time_date_format', [$this, 'getDateFormat']),
        ];
    }

    /**
     * @param DateTimeInterface $dt
     * @param string            $locale
     *
     * @return string
     */
    public function getDateFormat(DateTimeInterface $dt, string $locale = 'fr') : string {
        $formatter = new \IntlDateFormatter($locale, \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
        return $formatter->format($dt);
    }

    /**
     * @param ProductInterface $product
     *
     * @return array
     */
    public function getSupportedMethods(ProductInterface $product): array
    {
        $shipment = new Shipment();
        $item     = new OrderItem();
        $item->setVariant($product->getEnabledVariants()->first());
        $itemUnit = new OrderItemUnit($item);

        $channel = $this->channelContext->getChannel();
        /** @var OrderInterface $order */
        $order = $this->contextCart->getCart();

        if ($channel instanceof DefaultShippingZoneAwareInterface) {
            $address = $this->createAddressFromChannelDefaultShippingZone($channel);
            if (!empty($address)) {
                $order->setShippingAddress($address);
            }
        }

        $itemUnit->setShipment($shipment);
        $shipment->addUnit($itemUnit);
        $shipment->setOrder($order);

        return $this->shippingMethodsResolver->getSupportedMethods($shipment);
    }

    /**
     * @param ChannelInterface        $channel
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return DateTimeInterface|null
     */
    public function nextShipmentDateRFC2822(ChannelInterface $channel, ShippingMethodInterface $shippingMethod): ?string
    {
        $nextShipmentDateTime = $this->nextShipmentDateTimeProvider->getNextShipmentDateTime($channel, $shippingMethod);
        if (null === $nextShipmentDateTime) {
            return null;
        }

        return $nextShipmentDateTime->format(DateTimeInterface::RFC2822);
    }

    /**
     * @param ChannelInterface        $channel
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return DateTimeInterface|null
     */
    public function nextShipmentDate(ChannelInterface $channel, ShippingMethodInterface $shippingMethod): ?DateTimeInterface
    {
        return $this->nextShipmentDateTimeProvider->getNextShipmentDateTime($channel, $shippingMethod);
    }

    /**
     * @param ChannelInterface $channel
     *
     * @return array
     */
    public function getAllShippingMethod(ChannelInterface $channel): array
    {
        return $this->methodRepository->findEnabledForChannel($channel);
    }

    /**
     * @param ChannelInterface                      $channel
     * @param ShippingMethodCountdownAwareInterface $shippingMethod
     * @param ProductInterface|null                 $product
     *
     * @return \DateTime|null
     */
    public function getMinDeliveryDateEstimate(
        ChannelInterface $channel,
        ShippingMethodCountdownAwareInterface $shippingMethod,
        ProductInterface $product = null): ?\DateTime
    {
        if (empty($shippingMethod->getDeliveryWeekdays())) return null;

        return $this->getDeliveryDateEstimate($channel, $shippingMethod, $shippingMethod->getDeliveryMinTime(), $product);
    }

    /**
     * @param ChannelInterface                      $channel
     * @param ShippingMethodCountdownAwareInterface $shippingMethod
     * @param ProductInterface|null                 $product
     *
     * @return \DateTime|null
     */
    public function getMaxDeliveryDateEstimate(
        ChannelInterface $channel,
        ShippingMethodCountdownAwareInterface $shippingMethod,
        ProductInterface $product = null): ?\DateTime
    {
        if (empty($shippingMethod->getDeliveryWeekdays())) return null;

        return $this->getDeliveryDateEstimate($channel, $shippingMethod, $shippingMethod->getDeliveryMaxTime(), $product);
    }

    /**
     * @param ChannelInterface                      $channel
     * @param ShippingMethodCountdownAwareInterface $shippingMethod
     * @param int                                   $additionalDeliveryTime
     * @param ProductInterface|null                 $product
     *
     * @return array|\DateTime
     */
    protected function getDeliveryDateEstimate(
        ChannelInterface $channel,
        ShippingMethodCountdownAwareInterface $shippingMethod,
        int $additionalDeliveryTime,
        ProductInterface $product = null): \DateTime
    {
        $nextShipmentDateTime = $this->nextShipmentDateTimeProvider->getNextShipmentDateTime($channel, $shippingMethod);
        if (empty($nextShipmentDateTime)) {
            return new \DateTime();
        }

        if ($product instanceof ProductCountdownAwareInterface) {
            $additionalDeliveryTime += intval($product->getAdditionalDeliveryTime());
        }

        $deliveryTime = $shippingMethod->getAdditionalDeliveryTime()[$channel->getCode()] ?? [];
        if (!empty($deliveryTime['day'])) {
            $additionalDeliveryTime += $deliveryTime['day'];
        }

        $currentDate = clone $nextShipmentDateTime;
        for ($i = 1; $i <= $additionalDeliveryTime; $i++) {
            $currentDate->add(new \DateInterval('P1D'));
            $keyOfWeek              = intval(date("w", $currentDate->getTimestamp()));
            $deliveryNbr            = $this->guessAdditionalDeliveryTime($shippingMethod->getDeliveryWeekdays(), $keyOfWeek);
            $additionalDeliveryTime += $deliveryNbr;
        }

        return $nextShipmentDateTime->modify(sprintf('+%s day', $additionalDeliveryTime));
    }

    /**
     * @param array $deliveryWeekdays
     * @param int   $keyOfWeek
     *
     * @return int
     */
    protected function guessAdditionalDeliveryTime(array $deliveryWeekdays, int $keyOfWeek): int
    {
        $diff = array_diff(self::_DAYS_OF_WEEK, $deliveryWeekdays);
        $key  = array_search($keyOfWeek, $diff);
        return ($key !== false) ? 1 : 0;
    }

    /**
     * @param DefaultShippingZoneAwareInterface $channel
     *
     * @return AddressInterface|null
     */
    protected function createAddressFromChannelDefaultShippingZone(DefaultShippingZoneAwareInterface $channel): ?AddressInterface
    {
        $defaultShippingZone = $channel->getDefaultShippingZone();

        if (empty($defaultShippingZone)) return null;

        $address = new Address();

        if ($defaultShippingZone->getType() === ZoneInterface::TYPE_PROVINCE) {
            $member = $this->zoneHelper->getFirstProvinceFromZone($defaultShippingZone);

            if (empty($member)) return null;

            $address->setCountryCode($member->getCountry()->getCode());
            $address->setProvinceCode($member->getCode());
        }

        if ($defaultShippingZone->getType() === ZoneInterface::TYPE_COUNTRY) {
            $member = $this->zoneHelper->getFirstCountryFromZone($defaultShippingZone);

            if (empty($member)) return null;

            $address->setCountryCode($member->getCode());
        }

        return $address;
    }
}
