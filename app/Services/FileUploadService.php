<?php

namespace App\Services;

use Mail;
use SMS;
use \Illuminate\Http\UploadedFile;

use App\Models\Message;
use App\Models\User;

class FileUploadService
{
    /**
     * 將上傳的檔案儲存至指定路徑。
     *
     * @param \App\Models\User $recipient
     * @param \App\Models\Message $message
     * @return void
     */
    public function storeFile(UploadedFile $file, $path, $filename = null)
    {
        if ($file->isValid()) {
            $filename = $filename ?? $file->getClientOriginalName();

            $file->move($path, $filename);

            return true;
        }

        return false;
    }
}
