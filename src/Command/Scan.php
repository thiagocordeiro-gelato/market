<?php declare(strict_types=1);

namespace App\Command;

use App\Market\Checkout;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Scan extends Command
{
    /** @var Checkout */
    private $checkout;

    public function __construct(Checkout $checkout)
    {
        parent::__construct('scan');

        $this->checkout = $checkout;
    }

    protected function configure()
    {
        $this
            ->setDescription('Scan products by a given list')
            ->addArgument('SKUs', InputArgument::REQUIRED, 'List of SKUs to be scanned, ex (A,A,B,C)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $input = $input->getArgument('SKUs');

        if (!is_string($input)) {
            throw new Exception('Invalid product input, try bin/console scan -h for help');
        }

        $skus = explode(',', $input);

        foreach ($skus as $sku) {
            $this->checkout->scan($sku);
        }

        $output->writeln("<info>{$this->checkout->total()}<info>");

        return null;
    }
}
