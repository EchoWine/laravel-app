<?php

namespace $NAMESPACE$\Http\Controllers;
use Request;

class WelcomeController extends Controller{
   
	public function index(Request $request){
		return view('$NAMESPACE$::welcome');
	}

}
