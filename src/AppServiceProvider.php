<?php 

namespace EchoWine\Laravel\App;

use Illuminate\Support\ServiceProvider;
use File;

class AppServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){

    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){

        $this -> makePath();

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(){
        return [];
    }

    /**
     * Create basic path if doesn't exists
     */
    public function makePath(){
        $path = base_path('src');

        if(!File::exists($path))
            File::makeDirectory($path, 0775, true);
    }
}
