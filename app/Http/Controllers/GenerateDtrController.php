<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\GenerateDtrService;

class GenerateDtrController extends Controller
{
    
    public function __construct(public GenerateDtrService $generateDtrService) {
    }
    
    /**
     * Generates a DTR
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function Generate(Request $request)
    {
        return  $this->generateDtrService->generate($request);
    }

}
