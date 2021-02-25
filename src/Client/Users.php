<?php

namespace Yvv\UsersServiceClient\Client;

use Rpc\CreateRequest;
use Rpc\DelRequest;
use Rpc\ReadRequest;
use Rpc\UpdateRequest;
use Rpc\usersClient;

class Users
{
    private const DEFAULT_SERVER_HOST = '127.0.0.1';
    private const DEFAULT_SERVER_PORT = 1234;

    private $serverHost;
    private $serverPort;
    private $client;

    public function initClient(): void
    {
        $serverAddress = sprintf("%s:%s", $this->serverHost, $this->serverPort);

        $this->client = new usersClient($serverAddress, [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
        ]);
    }

    /**
     * Setter for serverHost
     *
     * @param string $host
     * @return void
     */
    public function setServerHost(string $host = null): void
    {
        if (empty($host)) {
            $this->serverHost = self::DEFAULT_SERVER_HOST;
        } else {
            $this->serverHost = $host;
        }
    }

    /**
     * Setter for serverPort
     *
     * @param integer $port
     * @return void
     */
    public function setServerPort(int $port = null): void
    {
        if (empty($port)) {
            $this->serverPort = self::DEFAULT_SERVER_PORT;
        } else {
            $this->serverPort = $port;
        }
    }

    /**
     * Create user via grpc.
     *
     * @param string $name
     * @param string $email
     * @param integer $age
     * @return string
     */
    public function createUser(
        string $name,
        string $email,
        int $age
    ): string {
        // Init request
        $createRequest = new CreateRequest();
        $createRequest->setName($name);
        $createRequest->setEmail($email);
        $createRequest->setAge($age);

        // Get response
        list($createResponse, $status) = $this->client->Create($createRequest)->wait();
        if (
            (int) $status->code === 0
            && $createResponse->getResult()
        ) {
            return 'SUCCES';
        }

        return 'ERROR: ' . $status->details;
    }

    /**
     * Read user via grpc.
     *
     * @param integer $id
     * @return string
     */
    public function readUser(int $id): string
    {
        $readRequest = new ReadRequest();
        $readRequest->setId($id);

        list($readResponse, $status) = $this->client->Read($readRequest)->wait();
        if ((int) $status->code === 0) {
            return sprintf('%s %s %d', $readResponse->getName(), $readResponse->getEmail(), $readResponse->getAge());
        }

        return 'ERROR: ' . $status->details;
    }

    /**
     * Update user via grpc.
     *
     * @param integer $id
     * @param string $name
     * @param string $email
     * @param integer $age
     * @return string
     */
    public function updateUser(
        int $id,
        string $name,
        string $email,
        int $age
    ): string {
        $updateRequest = new UpdateRequest();
        $updateRequest->setId($id);
        $updateRequest->setName($name);
        $updateRequest->setEmail($email);
        $updateRequest->setAge($age);

        list($updateResponse, $status) = $this->client->Update($updateRequest)->wait();
        if (
            (int) $status->code === 0
            && $updateResponse->getStatus()
            ) {
            return  'SUCCESS';
        }

        return 'ERROR: ' . $status->details;
    }

    /**
     * Delete usr via grpc.
     *
     * @param integer $id
     * @return string
     */
    public function delUser(int $id): string
    {
        $delRequest = new DelRequest();
        $delRequest->setId($id);

        list($delResponse, $status) = $this->client->Del($delRequest)->wait();
        if (
            (int) $status->code === 0
            && $delResponse->getStatus()
            ) {
            return  'SUCCESS';
        }

        return 'ERROR: ' . $status->details;
    }
}
