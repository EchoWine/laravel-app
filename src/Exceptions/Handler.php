<?php

namespace EchoWine\Laravel\App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as BaseHandler;

class Handler extends BaseHandler{

	public static $handlers = [];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
    	# Search throught all Handler defined in Package

    	foreach($this -> getHandlers() as $handler){
    		$handler -> report($exception);
    	}

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {


    	foreach($this -> getHandlers() as $handler) {
    		
    		if($return = $handler -> render($request,$exception))
    			return $return;
    	}

    	# Search throught all Handler defined in Package
        return parent::render($request, $exception);
    }

    /**
     * Get Handlers
     *
     * @return Array
     */
    public function getHandlers()
    {
        try {
            return $this -> container -> make('exceptions_handlers');
        } catch(\Exception $e) {
            return [];
        }
    }
}