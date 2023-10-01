<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
class ConstDataController extends Controller {
    const uriTextsMarkdown = [
        '/privacy-policy' => [
            'title'     => "سياسة الخصوصية",
            'command'   => 'privacy-policy'
        ],
        '/terms-of-use' => [
            'title'     => "شروط الإستخدام",
            'command'   => 'terms-of-use'
        ],
        '/refund-of-funds' => [
            'title'     => "سياسة رد الأموال",
            'command'   => 'refund-of-funds'
        ],
    ];
}
