<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $websites = Cache::rememberForever('websites', fn () => Website::all());

        return response()->json([
            'status' => true,
            'message' => 'Websites fetched successfully.',
            'data' => [
                'websites' => $websites,
            ],
        ]);
    }
}
