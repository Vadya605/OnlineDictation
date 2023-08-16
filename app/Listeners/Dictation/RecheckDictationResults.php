<?php

namespace App\Listeners\Dictation;

use App\Events\Dictation\DictationAnswerUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Admin\DictationResultService;
use Illuminate\Support\Facades\Artisan;

class RecheckDictationResults
{
    /**
     * Create the event listener.
     */

    public $dictationResultService;

    public function __construct(DictationResultService $dictationResultService)
    {
        $this->dictationResultService = $dictationResultService;
    }

    /**
     * Handle the event.
     */
    public function handle(DictationAnswerUpdated $event): void
    {
        $this->dictationResultService->resetResults($event->updatedDictation);

        Artisan::call('dictation-result:check', [
            '--dictation' => $event->updatedDictation->slug,
        ]);
    }
}
