<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VarController extends Controller
{




    private $h,$m,$a,$r,$d,$s,$sec;
    public function __construct() {
        $this->h = new HomeController();
        $this->m = new MemberController();
        $this->a = new AnalysisController();
        $this->r = new HistoryController();
        $this->d = new Add_adminController();
        $this->s  =new SittingController();
        $this->sec = new SectionController();
    }

    public static function navbarLink()
    {
        $admin_link =  [
            [
                'to' => route('dashboard'),
                'icon' => 'fa-solid fa-home',
                'title' => "الصفحة الرئيسية"
            ],
            [
                'to' => route('dashboard.member'),
                'icon' => 'fa-solid fa-users',
                'title' => "الأعضاء"
            ],
            [
                'to' => route('dashboard.analysis'),
                'icon' => 'fa-solid fa-chart-line',
                'title' => "الإحصائيات"
            ],
            [
                'to' => route('dashboard.history'),
                'icon' => 'fa-solid fa-history',
                'title' => "السجلات"
            ],
            [
                'to' => route('dashboard.add-admin'),
                'icon' => 'fa-solid fa-user',
                'title' => "إضافة أدمن"
            ],
            [
                'to' => route('dashboard.sitting'),
                'icon' => 'fa-solid fa-cog',
                'title' => "الإعدادات"
            ],
            [
                'to' => route('dashboard.add-category'),
                'icon' => 'fa-solid fa-book',
                'title' => "إضافة قسم"
            ],
            [
                'to' => route('dashboard.add-product'),
                'icon' => 'fa-solid fa-shop',
                'title' => "إضافة منتج"
            ],
            [
                'to' => route('dashboard.add-coupon'),
                'icon' => 'fa-solid fa-tags',
                'title' => "إضافة خصم"
            ],
        ];

        return $admin_link;
    }

    public function boxs()
    {
        $boxs = [
            [
                'title' => 'عدد المنتجات',
                'icon' => 'fa-solid fa-cart-shopping',
                'number' => $this->h->get_num_product()
            ],
            [
                'title' => 'عدد البائعين',
                'icon' => 'fa-solid fa-users',
                'number' => $this->h->get_num_seller()
            ],
            [
                'title' => 'عدد الأعضاء',
                'icon' => 'fa-solid fa-circle-user',
                'number' => $this->h->get_num_user()
            ],
            [
                'title' => 'إجمالي المبيعات',
                'icon' => 'fa-solid fa-tags',
                'number' => $this->h->get_count_sell_all()
            ],
            [
                'title' => 'مبيعات اليوم',
                'icon' => 'fa-solid fa-cart-arrow-down',
                'number' => $this->h->get_count_sell_day()
            ],
            [
                'title' => 'زيارات اليوم',
                'icon' => 'fa-solid fa-calendar-days',
                'number' => $this->h->get_num_daily_visit()
            ],
            [
                'title' => 'زيارات الشهر',
                'icon' => 'fa-regular fa-calendar-days',
                'number' => $this->h->get_num_month_visit()
            ],
            [
                'title' => 'إجمالي الربح',
                'icon' => 'fa-solid fa-coins',
                'number' => '2500' . '$'
            ],
        ];
        return $boxs;
    }

    public function users()
    {
        return $this->h->get_latest_users();
    }

    public function orders()
    {
        return $this->h->get_latest_orders();
    }

    public function member($type,$order )
    {
        return $this->m->get_members($type,$order);
    }

    public function month_visit()
    {
        return $this->a->get_month_visit();
    }

    public function month_sell()
    {
        return $this->a->get_month_sell();
    }

    public function month_buy()
    {
        return $this->a->get_month_buy();
    }

    public function user_country()
    {
        return $this->a->get_country_user();
    }

    public function records()
    {
        return $this->r->get_records();
    }

    public function admins()
    {
        return $this->d->get_admin();
    }

    public function sittings()
    {
        $name =['اسم الموقع','الوصف','العلامات الوصفية','صورة الموقع','ايدي حساب الفيسبوك','معرف حساب تويتر'];
        $type = ['text','text','text','file','text','text'];
        $required = [true,true,true,false,false,false];
        $date = $this->s->get_command();
        $command=[];
        for ($i=0; $i <count($date) ; $i++) {
            $command[$i]=[
                'name' => $name[$i],
                'type' => $type[$i],
                'id' => $date[$i]->command,
                'required' => $required[$i],
                'value' => $date[$i]->value
            ];
        }
      return $command;
    }


    public function sections()
    {
        return $this->sec->get_sections();
    }

}
