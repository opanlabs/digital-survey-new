<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Illuminate\Http\Request;

class AutoDeployController extends Controller
{
    public function deploy()
    {
        $process = new Process(['git', 'pull','origin','master']);  
        $process->run();
        // dd($process);

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}
