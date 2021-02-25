<?php

use Garden\Cli\Cli;
use Yvv\UsersServiceClient\Client\Users;

require dirname(__FILE__) . '/vendor/autoload.php';

$users = new Users;

$cli = Cli::create()
    ->opt('host:h', 'Server ip address.', true)
    ->opt('port:h', 'Server port.', true)
// Defind create command.
    ->command('create')
    ->description('Create user on server.')
    ->arg('name', 'Name of user.', true)
    ->arg('email', 'User email.', true)
    ->arg('age', 'User age.', true)
// Define read command.
    ->command('read')
    ->description('Read user from server.')
    ->arg('id', 'User id.', true)
// Define update command.
    ->command('update')
    ->description('Update user on server.')
    ->arg('id', 'User id.', true)
    ->arg('name', 'Name of user.', true)
    ->arg('email', 'User email.', true)
    ->arg('age', 'User age.', true)
    ->command('del')
    ->description('Delete user from server.')
    ->arg('id', 'User id.', true);

// Parse and return cli args.
$args = $cli->parse($argv, true);
$command = $args->getCommand();
$host = $args->getOpt('host');
$port = $args->getOpt('port');
echo 'host: ' . $host . PHP_EOL;
echo 'port: ' . $port . PHP_EOL;
echo 'command: ' . $command . PHP_EOL;

$users->setServerHost($host);
$users->setServerPort($port);
$users->initClient();

switch ($command) {
    case 'create':
        echo $users->createUser(
            $args->getArg('name'),
            $args->getArg('email'),
            $args->getArg('age')
        ) . PHP_EOL;
        break;
    case 'read':
        echo $users->readUser($args->getArg('id')) . PHP_EOL;
        break;
    case 'update':
        echo $users->updateUser(
            $args->getArg('id'),
            $args->getArg('name'),
            $args->getArg('email'),
            $args->getArg('age')
        ) . PHP_EOL;
        break;
    case 'del':
        echo $users->delUser($args->getArg('id')) . PHP_EOL;
        break;
    default:
        echo 'unknown command' . PHP_EOL;
}
