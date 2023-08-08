<?php

namespace App\Console\Commands\DictationResult;

use Illuminate\Console\Command;
use App\Services\Admin\DictationResultService;
use App\Services\Admin\DictationService;

class CheckDictationResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dictation-result:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check dictation result';

    protected $dictationResultService;
    protected $dictationService;

    public function __construct(DictationResultService $dictationResultService, DictationService $dictationService)
    {
        parent::__construct();
        $this->dictationResultService = $dictationResultService;
        $this->dictationService = $dictationService;
    }

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $checkableDictation = $this->dictationService->getActive();
        
        foreach($checkableDictation->results as $dictationResult){
            if(!$dictationResult->is_checked){
                $this->dictationResultService->update($dictationResult, [
                    'is_checked' => true,
                    'mark' => $this->dictationResultService->isCorrect($dictationResult) ? 10 : 2
                ]);
            }
        }
    }
}
