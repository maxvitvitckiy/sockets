<?php
namespace App\Helpers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Websocket implements MessageComponentInterface {
    protected $clients;
    protected $rooms;

    public function __construct() {
        $this->clients = new \SplObjectStorage();
        $this->rooms = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "connection created\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg);
        if($msg->type == "connection") {
            if(!array_key_exists($msg->value ,$this->rooms)){
                $this->rooms[$msg->value] = [];
            }
            dump(1);
            $this->rooms[$msg->value][$from->resourceId] = $from;
        }
        if($msg->type == "message") {
            dump(3);
            foreach ($this->rooms[$msg->room] as $client) {
                if ($from != $client) {
                    dump(2);
                    $client->send($msg->value);
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        $room = $this->users[$conn->resourceId];
        unset($this->rooms[$room][$conn->resourceId]);
        echo "disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        dump($e->getMessage());
        $conn->close();
    }
}
