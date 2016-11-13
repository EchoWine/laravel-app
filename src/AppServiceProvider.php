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

        $this -> makePath();

        $this -> loadPackages();
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){


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
     *
     * @return void
     */
    public function makePath(){
        $path = base_path('src');

        if(!File::exists($path))
            File::makeDirectory($path, 0775, true);
    }

    /**
     * Load package
     *
     * @return void
     */
    public function loadPackages(){
        $path = base_path('src');

        new \Example\Providers\AppServiceProvider();
        
        $packages = collect();

        foreach(glob($path."/*") as $directory){
        
            $name = basename($directory);

            $file = $directory."/Package.php";
            $class = "{$name}\Package";

            if(File::exists($file)){
                require $file;
                echo $class;
                echo "<br>";
                $class = new $class($this -> app,$directory,$name);
                $class -> register();

                $packages[] = $class;
            }
        }



        $packages -> map(function($package){
            $package -> boot();
        });


    }
}
