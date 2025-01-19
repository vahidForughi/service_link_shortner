<?php

namespace App\Services\RabbitMQ;

use App\Services\RabbitMQ\Consumers\RabbitMQConsumerAbstract;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private $channel;

    public function __construct(
        private readonly AMQPStreamConnection $connection
    ) {
        $this->channel = $this->connection->channel();
        $this->preparation();
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function preparation(): void
    {
        foreach (QueueEnum::cases() as $queue) {
            $this->channel->queue_declare(
                queue: $queue->value,
                passive: false,
                durable: true,
                exclusive: false,
                auto_delete: false
            );
        }

        foreach (ExchangeEnum::cases() as $exchange) {
            $this->channel->exchange_declare(
                exchange: $exchange->value,
                type: $type = $exchange->type(),
                passive: false,
                durable: true,
                auto_delete: false
            );

            foreach ($exchange->binds() as $bind) {
                $this->channel->queue_bind(
                    queue: $bind->queue->value,
                    exchange: $exchange->value,
                    routing_key: $bind->routingKey->value,
                );
            }
        }
    }

    /**
     * @throws \Exception
     */
    public function publish($exchange, $message, $routingKey = '')
    {
        $this->channel->basic_publish(
            msg: new AMQPMessage(
                body: $this->messageEncode($message),
                properties: [
                    'content_type' => 'plane/text',
                    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
                ]
            ),
            exchange: $exchange,
            routing_key: !empty($routingKey) ? $routingKey : '',
        );
    }

    public function consume()
    {
        foreach (QueueEnum::cases() as $queue) {
            foreach ($queue->consumers() as $consumer) {
                $this->channel->basic_consume(
                    queue: $queue->value,
                    consumer_tag: sprintf("%s.%s.%d", $queue->value, $consumer, time()),
                    callback: [$consumer, 'handle'],
                );
            }
        }

        try {
            $this->channel->consume();
        } catch (\Throwable $exception) {
            dump($exception);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function messageEncode($message): false|string
    {
        return base64_encode(json_encode($message, JSON_THROW_ON_ERROR));
    }

    public function messageDecode($message)
    {
        $decoded_message = base64_decode($message);
        return json_validate($decoded_message, 512, JSON_INVALID_UTF8_IGNORE)
            ? json_decode($decoded_message, false, 512, JSON_THROW_ON_ERROR)
            : $decoded_message;
    }
}
