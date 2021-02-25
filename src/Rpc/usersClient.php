<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Rpc;

/**
 */
class usersClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Rpc\CreateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Create(\Rpc\CreateRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/rpc.users/Create',
        $argument,
        ['\Rpc\CreateResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Rpc\ReadRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Read(\Rpc\ReadRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/rpc.users/Read',
        $argument,
        ['\Rpc\ReadResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Rpc\UpdateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Update(\Rpc\UpdateRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/rpc.users/Update',
        $argument,
        ['\Rpc\UpdateResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Rpc\DelRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Del(\Rpc\DelRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/rpc.users/Del',
        $argument,
        ['\Rpc\DelResponse', 'decode'],
        $metadata, $options);
    }

}
