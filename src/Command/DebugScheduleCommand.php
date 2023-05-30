<?php

declare(strict_types=1);

namespace Asdoria\SyliusShippingDeliveryTimePlugin\Command;

use \DateTime;
use Asdoria\SyliusShippingDeliveryTimePlugin\Provider\NextShipmentDateTimeProviderInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class DebugScheduleCommand extends Command
{
    protected static $defaultName = 'asdoria:shipping-delivery-time:debug';

    private const DATETIME_FORMAT = 'D, Y-m-d H:i:s P';

    private ChannelRepositoryInterface $channelRepository;

    private NextShipmentDateTimeProviderInterface $provider;

    /** @psalm-suppress PropertyNotSetInConstructor */
    private SymfonyStyle $io;

    public function __construct(
        ChannelRepositoryInterface $channelRepository,
        NextShipmentDateTimeProviderInterface $provider
    ) {
        $this->channelRepository = $channelRepository;
        $this->provider = $provider;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('at', InputArgument::OPTIONAL, 'At which datetime?', 'now')
            ->addArgument('channel', InputArgument::OPTIONAL, 'For what channel?', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new SymfonyStyle($input, $output);

        $channels = [];
        $channelCode = $input->getArgument('channel');
        if (null === $channelCode) {
            /** @var ChannelInterface[] $channels */
            $channels = $this->channelRepository->findAll();
        } else {
            /** @var ChannelInterface|null $channel */
            $channel = $this->channelRepository->findOneByCode($channelCode);
            Assert::notNull($channel, sprintf('Channel %s was not found', $channelCode));
            $channels[] = $channel;
        }

        $at = $input->getArgument('at');
        $atDateTime = new DateTime($at);

        $this->io->writeln(sprintf(
            'Searching shipment date for %s...',
            $atDateTime->format(self::DATETIME_FORMAT)
        ));

        $table = new Table($this->io);
        $table->setHeaders([
            'Channel',
            'Next shipment at',
        ]);

        foreach ($channels as $channel) {
            $nextShipmentDateTime = $this->provider->getNextShipmentDateTime($channel, $atDateTime);
            if (null === $nextShipmentDateTime) {
                $table->addRow([
                    $channel->getCode(),
                    '<error>Not found</error>',
                ]);
            } else {
                $table->addRow([
                    $channel->getCode(),
                    $nextShipmentDateTime->format(self::DATETIME_FORMAT),
                ]);
            }
        }

        $table->render();

        return 0;
    }
}
