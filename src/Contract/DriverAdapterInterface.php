<?php

namespace App\Contract;

/**
 * Interface ProviderInterface
 *
 * @package App\Contract
 */
interface DriverAdapterInterface
{
    /**
     * @param ProviderInterface $provider
     * @return DriverAdapterInterface
     */
    public function setProvider(ProviderInterface $provider): self;

    /**
     * @param array $query
     * @return array
     */
    public function listFiles(array $query = []): array;
}
