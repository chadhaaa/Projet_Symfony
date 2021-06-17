<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserAddrolesCommand extends Command
{
    protected static $defaultName = 'app:user:addroles';
    private $em; 
    public function __construct(EntityManagerInterface $em)
    {
        $this->em =$em;
        parent::__construct();
    }
    protected static $defaultDescription = 'Adding roles to our users';

    protected function configure()
    {
        $this
            ->setDescription("Modifier un utilisateur en lui ajoutant de nouveaux roles")
            ->addArgument('email', InputArgument::REQUIRED, 'Email adress of the user you want to edit')
            ->addArgument('Roles', InputArgument::REQUIRED, 'The roles you wnat to add to the user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $Roles = $input->getArgument('Roles');
        $userRepository= $this->em->getRepository(User::class);
        $user=$userRepository->findOneByEmail($email);


        if ($user) {
            $user->addRoles($Roles);
            $this->em->flush();

            $io->success('The roles have been successfully aded to the user.');
        }

        else  {
            $io->error('There is no user with that email adress.');

        }


        return 0;
    }
}