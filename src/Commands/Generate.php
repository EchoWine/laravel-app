<?php

namespace EchoWine\Laravel\App\Commands;

use Illuminate\Console\Command;

use EchoWine\Laravel\App\Generator;

class Generate extends Command{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'src:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all basics files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $name = ucfirst($this -> argument('name'));

        $path = base_path("src/{$name}/");

        try{

            $gn = new Generator($path);
        
        }catch(\Exception $e){

            $this -> error($e -> getMessage());
        }

        $v = $this -> laravel -> make('src.version')."/";

        $gn -> put("$v/routes.php","routes.php",[
            'URL' => strtolower($name)
        ]);

        $gn -> put("$v/Package.php","Package.php",[
            'NAMESPACE' => $name
        ]);

        $gn -> put("$v/Resources/views/welcome.blade.php","Resources/views/welcome.blade.php",[
            'NAMESPACE' => $name
        ]);

        $gn -> put("$v/Resources/public/assets/welcome/main.css","Resources/public/assets/welcome/main.css");

        $gn -> put("$v/Providers/AppServiceProvider.php","Providers/AppServiceProvider.php",[
            'NAMESPACE' => $name
        ]);

        $gn -> put("$v/Providers/RouteServiceProvider.php","Providers/RouteServiceProvider.php",[
            'NAMESPACE' => $name
        ]);

        $gn -> put("$v/Http/Controllers/Controller.php","Http/Controllers/Controller.php",[
            'NAMESPACE' => $name
        ]);

        $gn -> put("$v/Http/Controllers/WelcomeController.php","Http/Controllers/WelcomeController.php",[
            'NAMESPACE' => $name
        ]);

        $gn -> put("$v/Console/Commands/Welcome.php","Console/Commands/Welcome.php",[
            'NAMESPACE' => $name,
            'NAME' => strtolower($name)
        ]);

        if($v != "5.1/"){
            $gn -> put("$v/Exceptions/Handler.php","Exceptions/Handler.php",[
                'NAMESPACE' => $name
            ]);
        }


        $this -> info("\n".$name." generated");
    }
}