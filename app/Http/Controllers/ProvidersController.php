<?php

namespace App\Http\Controllers;

use App\Services\ProviderService;

class ProvidersController extends Controller
{
    /**
     * @var providerService
     */
    protected $providerService;

    /**
     * ProvidersController Constructor
     *
     * @param ProviderService $providerService
     *
     */
    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }

    /**
     * Show all Providers
     */
    public function index(){
        try{
            $providers = $this->providerService->getAll();

            return response()->json([
                'users' => $providers
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
