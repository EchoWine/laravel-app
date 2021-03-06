<?php 

namespace EchoWine\Laravel\App;

use Illuminate\Support\ServiceProvider;
use EchoWine\Laravel\App\Commands as Commands;
use File;

class AppServiceProvider extends ServiceProvider
{

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    public $app;

    /**
     * List of all exceptions handlers
     *
     * @var Array
     */
    public $exceptions_handlers = [];

    /**
     * List of all version accepted
     *
     * @var Array
     */
    public $versions = ['5.1','5.3','5.4'];

    /**
     * Current version
     *
     * @var Array
     */
    public $version = ['5.1','5.3','5.4'];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->makePath();

        $this->commands([Commands\Generate::class]);

        $this->loadPackages();

        $v = explode(".",$this->app->version());
        $v = $v[0].".".$v[1];

        if(!in_array($v,$this->versions))
            throw new \Exception("Version {$this->app->version()} not supported");

        $this->version = $v;

        $this->app->bind('src.version',function() {
            return $this->version;
        });



        $this->app->bind('exceptions_handlers',function() {
            return $this->exceptions_handlers;
        });

    }
    
    /**
     * Add a new exception handler
     *
     * @param string $class
     *
     * @return void
     */
    public function addExceptionsHandler($class)
    {

        $this->exceptions_handlers[] = new $class($this->app);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Create basic path if doesn't exists
     *
     * @return void
     */
    public function makePath()
    {
        $path = base_path('src');

        if(!File::exists($path))
            File::makeDirectory($path, 0775, true);
    }

    /**
     * Load package
     *
     * @return void
     */
    public function loadPackages()
    {
        $path = base_path('src');
        
        $packages = collect();

        foreach(glob($path."/*") as $directory){
        
            $name = basename($directory);

            $file = $directory."/Package.php";
            $class = "{$name}\Package";

            if(File::exists($file)){
                require $file;
                $class = new $class($this,$directory,$name);
                $class->boot();

                $packages[] = $class;
            }
        }


        $packages->map(function($package){
            $package->register();
        });


    }


    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    public function mergeConfigFrom($path, $key)
    {
        return parent::mergeConfigFrom($path, $key);
    }

    /**
     * Register a view file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    public function loadViewsFrom($path, $namespace)
    {
        return parent::loadViewsFrom($path, $namespace);
    }

    /**
     * Register a translation file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    public function loadTranslationsFrom($path, $namespace)
    {
        return parent::loadTranslationsFrom($path, $namespace);
    }

    /**
     * Register a database migration path.
     *
     * @param  array|string  $paths
     * @return void
     */
    public function loadMigrationsFrom($paths)
    {
        return parent::loadMigrationsFrom($paths);
    }

    /**
     * Register paths to be published by the publish command.
     *
     * @param  array  $paths
     * @param  string  $group
     * @return void
     */
    public function publishes(array $paths, $group = null)
    {
        return parent::publishes($path, $group);
    }
}
