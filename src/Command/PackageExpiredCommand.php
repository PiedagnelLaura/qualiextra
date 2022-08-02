<?php

namespace App\Command;

use App\Repository\PackageRepository;
use App\Entity\Package;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PackageExpiredCommand extends Command
{
    protected static $defaultName = 'app:package:expired';
    protected static $defaultDescription = 'disabled package after 365 days';


    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * 
     * @var PackageRepository
     */
    private $packageRepository;

    public function __construct(ManagerRegistry $managerRegistry, PackageRepository $packageRepository)
    {
        parent::__construct();

        $this->managerRegistry = $managerRegistry;
        $this->packageRepository = $packageRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $currentDate = new DateTime();

        $allPackages = $this->packageRepository->findAll();

        foreach ($allPackages as $package) {
            $packageDateDelete = $package->getExpireOn();
            if ($packageDateDelete !== null) {
                if ($packageDateDelete < $currentDate) {
                    $this->packageRepository->remove($package);
                    $text = 'Le package ' . $package->getName() . ' a bien été supprimé';
                    $io->success($text);
                }
            }
        }

        $manager = $this->managerRegistry->getManager();
        $manager->flush();

        return Command::SUCCESS;
    }
}
