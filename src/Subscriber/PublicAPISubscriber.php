<?php
declare(strict_types=1);

namespace App\Subscriber;

use App\Event\PublicAPIRequestEvent;
use EonX\EasyHttpClient\Data\RequestData;
use EonX\EasyHttpClient\Data\ResponseData;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class PublicAPISubscriber
{
    private EventDispatcherInterface $dispatcher;

    private FilesystemOperator $filesystem;

    public function __construct(EventDispatcherInterface $dispatcher, FilesystemOperator $publicApiStorage)
    {
        $this->dispatcher = $dispatcher;
        $this->filesystem = $publicApiStorage;
    }

    public function __invoke(RequestData $requestData, ResponseData $responseData): void
    {
        // You can directly run any stuff here
        $time = \time();
        try {
            $this->filesystem->write($time . '_request_data.txt', $requestData->getUrl());
            $this->filesystem->write($time . '_response_data.txt', $responseData->getContent());
        } catch (FilesystemException $exception) {
            // TODO: Handle error
        }

        // Or dispatch an event, so it's easier to listen/subscribe without editing the concrete client
        $this->dispatcher->dispatch(new PublicAPIRequestEvent($requestData, $responseData));
    }
}
