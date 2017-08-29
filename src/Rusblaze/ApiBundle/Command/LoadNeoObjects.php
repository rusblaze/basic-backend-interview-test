<?php
namespace Rusblaze\ApiBundle\Command;

use Psr\Log\LoggerInterface;
use Rusblaze\ApiBundle\Service\NasaNeoService;
use Rusblaze\CoreDomain\Neo\NeoRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadNeoObjects extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('rusblaze:load-neo')

            // the short description shown while running "php bin/console list"
            ->setDescription(
                'Request the data from the last 3 days from nasa api. ' .
                'Response contains count of Near-Earth Objects (NEOs)'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nasaService = $this->getContainer()->get(NasaNeoService::class);
        $logger = $this->getContainer()->get('logger');
        $neoRepository = $this->getContainer()->get('neo_repository');

        $today = new \DateTime();
        $start = (clone $today)->modify('-3 days');

        $neos = $nasaService->loadNeos($start, $today);
        foreach ($neos as $neo) {
            try {
                if (!$neoRepository->has($neo)) {
                    $neoRepository->add($neo);
                }
            } catch (\Exception $e) {
                $logger->warning(
                    'Could not add NEO',
                    [
                        'neo' => $neo,
                        'error' => $e->getMessage(),
                    ]
                );
            }
        }
    }
}