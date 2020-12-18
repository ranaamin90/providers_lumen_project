<?php

namespace App\Repositories;

use App\Http\Resources\ProviderResource;

class ProviderRepository
{
    /**
     * @var $providers
     */
    protected $providers;

    /**
     * Get all Providers.
     */
    public function getAll()
    {
        //The providers that stored in storage folder
        $providers = ['DataProviderX', 'DataProviderY'];

        $providersArray = [];
        foreach ($providers as $provider) {
            //Get Data from json file
            $file = \Illuminate\Support\Facades\File::get(storage_path('app/'.$provider.'.json'));
            $providerData = json_decode($file);

            foreach ($providerData as $data) {
                foreach ($data as $user) {
                    //To show Data with same key in all providers
                    if($provider == 'DataProviderX'){
                        $user = new ProviderResource($user);                        
                    }
                    //Add provider name to Obj to filter by it
                    $userObj = json_decode(collect($user));
                    $userObj->provider = $provider;
                    
                    $providersArray[] = $userObj;
                }  
            }    
        }
        
        $providersObj = collect($providersArray);

        //Search Paramaters
        $providerSearch = \request()->get('provider');
        $currency = \request()->get('currency');
        $status = \request()->get('statusCode');
        $balanceMin = \request()->get('balanceMin');
        $balanceMax = \request()->get('balanceMax');

        if (isset($providerSearch) || isset($currency) || isset($status) || (isset($balanceMin) && isset($balanceMax))) {
            $users = $providersObj->filter(function($event) use ($providerSearch, $currency, $status, $balanceMin, $balanceMax)
            {
                //Types of statusCode
                if ($status == 'authorised') {
                    $status = 1;
                }elseif ($status == 'decline') {
                    $status = 2;
                }elseif ($status == 'refunded') {
                    $status = 300;
                }
                //Return result by filter with one param or more
               return $event->provider == $providerSearch || $event->currency == $currency || $event->status == $status ||
               ($event->balance >= $balanceMin && $event->balance <= $balanceMax) ||
               ($event->provider == $providerSearch && $event->currency == $currency && $event->status == $status && 
               ($event->balance >= $balanceMin && $event->balance <= $balanceMax));
             });

             return $users;
        }

        return $providersObj;
    }
}