<?php

namespace App\Provider;

use App\Contract\ClientCreatorInterface;
use App\Contract\ProviderInterface;
use App\Model\File;

/**
 * Class GoogleDriver
 * @package App\Provider
 */
class GoogleDriver implements ProviderInterface
{
    const APPLICATION_NAME = 'Google Drive API';
    const ACCESS_TYPE = 'offline';
    const PAGE_SIZE = 20;

    /**
     * @var GoogleClientCreator $clientCreator
     */
    private $clientCreator;

    /**
     * @var \Google_Service_Drive $googleServiceDriver
     */
    private $googleServiceDriver;

    /**
     * GoogleDriver constructor.
     * @param ClientCreatorInterface $clientCreator
     */
    public function __construct(ClientCreatorInterface $clientCreator)
    {
        $this->clientCreator = $clientCreator;
        $this->googleServiceDriver = new \Google_Service_Drive($this->clientCreator->create());
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function listFiles(array $parameters = []): array
    {
        $parameters = array_merge($parameters, [
            'q' => "mimeType != 'application/vnd.google-apps.folder'",
            'pageSize' => self::PAGE_SIZE,
            'fields' => "files(id, name, mimeType, webContentLink, size)",
        ]);

        $results = $this->googleServiceDriver->files->listFiles($parameters);

        if (count($results->getFiles()) == 0) {
            return [];
        }

        $files = [];

        foreach ($results->getFiles() as $row) {
            $file = new File();
            $file->setName($row->getName())
                ->setId($row->getId())
                ->setDownloadLink($row->getWebContentLink())
                ->setMimeType($row->getMimeType())
                ->setSize($row->getSize());

            $files [] = $file;
        }

        return $files;
    }
}
