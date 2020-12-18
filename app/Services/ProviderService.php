<?php

namespace App\Services;

use App\Repositories\ProviderRepository;

class ProviderService
{
    /**
     * @var $providerRepository
     */
    protected $providerRepository;

    /**
     * ProviderService constructor.
     *
     * @param ProviderRepository $providerRepository
     */
    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * Get all Providers.
     */
    public function getAll()
    {
        return $this->providerRepository->getAll();
    }
}