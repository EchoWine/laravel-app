<?php

namespace EchoWine\Laravel\App;

use File;

class Generator{

	protected $base_path = '';

	public function __construct($base_path = ''){
		$this -> base_path = $base_path;

		if(glob($base_path."*")){
			throw new \Exception("Folder must be empty");
		}
	}

	public function put($source,$to,$data = []){
		$content = File::get(__DIR__."/stubs/".$source);

		$to = $this -> base_path.$to;

		$to_dir = dirname($to);

        if(!File::exists($to_dir))
            File::makeDirectory($to_dir, 0775, true);

        foreach($data as $n => $k)
        	$content = str_replace("$".$n."$",$k,$content);
        

       	File::put($to,$content);
	}

}