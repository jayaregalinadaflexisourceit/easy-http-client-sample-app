<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Event\PublicAPIRequestEvent;
use EonX\EasyCore\Bridge\Symfony\Event\KernelEventListenerTrait;
use EonX\EasyCore\Bridge\Symfony\Interfaces\EventListenerInterface;
use EonX\EasyHttpClient\Data\RequestData;
use League\Flysystem\FilesystemOperator;

final class RecordAllRequestListener implements EventListenerInterface
{
    use KernelEventListenerTrait;

    private FilesystemOperator $filesystem;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        $this->filesystem = $defaultStorage;
    }

    public function __invoke(PublicAPIRequestEvent $event)
    {
        $filename = \time() . '_request.json';

        if ($this->filesystem->fileExists($filename) === false) {
            $this->filesystem->write(
                $filename,
                \json_encode($this->content($event->getRequestData()), \JSON_THROW_ON_ERROR | \JSON_PRETTY_PRINT)
            );
        }
    }

    /**
     * @return mixed[]
     */
    private function content(RequestData $requestData): array
    {
        return [
            'method' => $requestData->getMethod(),
            'options' => $requestData->getOptions(),
            'sentAt' => $requestData->getSentAt(),
            'url' => $requestData->getUrl(),
        ];
    }
}
