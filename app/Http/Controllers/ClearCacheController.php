<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;

class ClearCacheController extends Controller
{
    /**
     * Clear various caches via Artisan commands.
     *
     * Only allowed in local environment for security.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAll()
    {
        // Restrict to local environment (so not exposed in production)
        if (!App::environment('local')) {
            abort(403, 'Forbidden');
        }

        $commands = [
            'config:clear',
            'route:clear',
            'view:clear',
            'cache:clear',
            'optimize:clear',
            'clear-compiled',
        ];

        $output = [];
        foreach ($commands as $command) {
            Artisan::call($command);
            $output[$command] = trim(Artisan::output());
        }

        return response()->json([
            'status' => 'success',
            'output' => $output,
        ]);
    }
}
