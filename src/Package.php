<?php 

namespace EchoWine\Laravel\App;

use File;

class Package{

    /**
     * app
     *
     * @var app
     */
    protected $app;

    /**
     * Base path package
     *
     * @var string
     */
    public $base_path;

    /**
     * Namespace
     *
     * @var string
     */
    public $namespace;

    /**
     * Construct
     *
     * @return this
     */
    public function __construct($app,$base_path,$namespace){
        $this -> app = $app;
        $this -> base_path = $base_path;
        $this -> namespace = $namespace;
    }

    /**
     * Register the package
     *
     * @return void
     */
    public function register(){

        $this -> load();
    }
    
    /**
     * Load contents of package
     *
     * @return void
     */
    public function load(){
        $this -> loadResources();
        $this -> loadProviders();
    }
    
    /**
     * Load providers
     * 
     * @return void
     */
    public function loadProviders(){
        $providers = $this -> getFiles('Providers');
        $providers -> map(function($file){
            $class = $this -> getClassByBasename(basename($file),'Providers\\');
            $this -> app -> register($class);
        });
    }

    /**
     * Load resources
     *
     * @return void
     */
    public function loadResources(){

    }

    /**
     * Get class by basename
     *
     * @return string
     */
    public function getClassByBasename($basename,$namespace = ''){
        $file = basename($basename,".php");
        $class = "\\".$this -> namespace."\\".$namespace.$file;
        return $class;
    }

    /**
     * get files
     *
     * @return collection
     */
    public function getFiles($directory){
        return collect(File::glob($this -> base_path."/{$directory}/*"));
    }

    /**
     * Bootstrap any application package
     *
     * @return void
     */
    public function boot(){

    }
}
