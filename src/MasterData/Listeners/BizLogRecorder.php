<?php

namespace App\Domains\MasterData\Listeners;

use App\Common\Event\BizLogEvent;
use App\Domains\MasterData\Contracts\BusinessLogService;
use App\Jobs\BusinessLogJob;

class BizLogRecorder
{
    protected $businessLogService;

    /**
     * Biz log record event listener.
     *
     * @return void
     */
    public function __construct(BusinessLogService $businessLogService)
    {
        $this->businessLogService = $businessLogService;
    }

    /**
     * Handle business operation log event
     *
     * @param BizLogEvent $event
     * @return void
     */
    public function handle(BizLogEvent $event)
    {
        dispatch((new BusinessLogJob($event->getContext()))->onQueue('log'));
    }
}
