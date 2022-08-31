<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Illuminate\Http\Request;

class AutoDeployController extends Controller
{
    public function deploy()
    {
        $process = new Process(['git', 'pull']);  
        $process->run();
        /* php artisan migrate */
       \Artisan::call('optimize');
        // dd($process);

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        response()->json(['status' => $process->getOutput()], 200);
    }
}
