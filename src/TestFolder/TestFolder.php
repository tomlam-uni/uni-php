<?php

namespace App\TestFolder;

use Illuminate\Support\Facades\Log;

class TestFolder
{
    public static function testSrcFolderOnly() {
        Log::info('this is src folder only');
    }
}
