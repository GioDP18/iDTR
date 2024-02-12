<?php
namespace App\Http\Services;

use Illuminate\Http\Request;

interface GenerateDtrService 
{

  
    public function __construct();

    /**
     * Service for generating DTR
     *
     * @param Request $request
     * @return void
     */
    public function generate(Request $request);
    
    
}