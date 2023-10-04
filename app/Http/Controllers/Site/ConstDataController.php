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
    const paymentMethod = [
        'payeer' => 'App\\Http\\Controllers\\PaymentGateways\\PayeerController',
        'payeer2' => 'App\\Http\\Controllers\\PaymentGateways\\PayeerController',
        'payeer3' => 'App\\Http\\Controllers\\PaymentGateways\\PayeerController',
        'payeer4' => 'App\\Http\\Controllers\\PaymentGateways\\PayeerController',
    ];
}
