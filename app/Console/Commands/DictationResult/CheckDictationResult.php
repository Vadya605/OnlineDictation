<?php

namespace App\Console\Commands\DictationResult;

use Illuminate\Console\Command;
use App\Services\Admin\DictationResultService;
use App\Services\Admin\DictationService;
use App\Models\Dictation;
use Illuminate\Database\Eloquent\Collection;

class CheckDictationResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dictation-result:check {--dictation=} {--active}';

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
        if($dictation = $this->option('dictation')){
            $checkableDictation = $this->dictationService->getBySlug($dictation);
        
            $this->dictationResultService->checkResults(Collection::make([$checkableDictation]));
        }elseif($this->option('active')){
            $checkableDictation = $this->dictationService->getActive();
            
            $this->dictationResultService->checkResults(Collection::make([$checkableDictation]));
        }else{
            $this->dictationService->getByChunk(function($dictationsChunk){
                $this->dictationResultService->checkResults($dictationsChunk);
            });
        }
    }
}
