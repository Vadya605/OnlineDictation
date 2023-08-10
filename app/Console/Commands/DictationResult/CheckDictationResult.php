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
    protected $signature = 'dictation-result:check {--dictation=} {--active} {--all}';

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
        
            $this->dictationResultService->checkResults($checkableDictation->results);
        }elseif($this->option('active')){
            $checkableDictation = $this->dictationService->getActive();

            $this->dictationResultService->checkResults($checkableDictation->results);
        }elseif($this->option('all')){
            $checkableDictations = $this->dictationService->getResultsAutoCompleteSearch();

            foreach($checkableDictations as $checkableDictation){
                $this->dictationResultService->checkResults($checkableDictation->results);
            }
        }else{
            $this->error('Для проверки необходимо указать одну из опций: --dictation=value, --active или --all');
        }
    }
}
