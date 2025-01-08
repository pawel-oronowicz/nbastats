<?php

namespace App\Command;

use App\Entity\Team;
use App\Entity\TeamHistory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import-teams')]
class ImportTeamsCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private $dirImport;
    private $columnIndexes;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->dirImport = getenv('DIR_IMPORT');

        parent::__construct();
    }

    /**
     * Configure command
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Imports historical NBA teams and their data.');
    }

    /**
     * Get column indexes for import file
     *
     * @return array
     */
    private function getColumnIndexes(): array
    {
        return $this->columnIndexes = [
            'name' => 0,
            'shortName' => 1,
            'from' => 2,
            'to' => 3,
            'sourceId' => 4
        ];
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getColumnIndexes();

        if(($handle = fopen($this->dirImport . 'data/import/nba_team_history.csv', 'r')) !== false) {
            // skip the header line
            fgetcsv($handle);

            while(($data = fgetcsv($handle)) !== false) {
                $isActive = ($data[$this->columnIndexes['to']] === '');
                $team = null;

                if($isActive) {
                    $team = new Team();
                    $team->setName($data[$this->columnIndexes['name']]);
                    $team->setShortName($data[$this->columnIndexes['shortName']]);
                    $team->setSourceId($data[$this->columnIndexes['sourceId']]);
                    $this->entityManager->persist($team);

                    // Flush to generate the ID for the new team
                    $this->entityManager->flush();
                }
                
                $teamHistory = new TeamHistory();
                if($team !== null) {
                    $teamHistory->setTeam($team);
                } else {
                    $existingTeam = $this->entityManager->getRepository(Team::class)
                        ->findOneBy(['sourceId' => intval($data[$this->columnIndexes['sourceId']])]);
                    $teamHistory->setTeam($existingTeam);
                }

                $teamHistory->setName($data[$this->columnIndexes['name']]);
                $teamHistory->setShortName($data[$this->columnIndexes['shortName']]);
                $teamHistory->setStartDate(new \DateTime($data[$this->columnIndexes['from']]));
                $teamHistory->setEndDate(
                    !$isActive 
                    ? new \DateTime($data[$this->columnIndexes['to']]) 
                    : null
                );

                $this->entityManager->persist($teamHistory);
            }

            fclose($handle);
            
            $this->entityManager->flush();

            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}