<?php
/**
 * Auther: sha-7
 * 06-05-16
 */
require __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command {

	protected function configure()
    {
        $this->setName('tcp:demo')
            ->setDescription('Testing out Guzzle\'s client code sample')
            ->addArgument(
                'HNAME',
                InputArgument::REQUIRED,
               	''
            )->addArgument(
				'PORT',
				InputArgument::REQUIRED,
				''
			);
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hname = $input->getArgument('HNAME');
		$port = $input->getArgument('PORT');

		$client = new GuzzleHttp\Client();
		$res = $client->request('GET', "{$hname}:{$port}");

		$output->writeln("<info>status:</info>" . $res->getStatusCode());
		// 200
//		echo $res->getHeaderLine('content-type');
		// 'application/json; charset=utf8'
	//	echo $res->getBody();
		// {"type":"User"...'

		// Send an asynchronous request.
//		$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
	//	$promise = $client->sendAsync($request)->then(function ($response) {
//			echo 'I completed! ' . $response->getBody();
	//	});
		//$promise->wait();
    }
}

$application = new Application();
$application->add(new GreetCommand());
$application->run();

