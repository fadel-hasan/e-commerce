<?php

namespace App\Http\Controllers\PaymentGateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayeerController extends Controller
{
    private $payeer;
    public function __construct()
    {
        $this->payeer = new CPayeerController(env('account_private'),env('id_private'),env('key_private'));
    }
    public function issetGet()
    {
        if (request('successPayeer') or request('failPayeer') or request('status')) {
            return true;
        }
        return false;
    }
    public function issetGetForPay()
    {
        if ($this->issetGet() and request('m_desc') and !empty(request('m_desc'))) {
            return true;
        }
        return false;
    }
    public function AmounyPay()
    {
        if ($this->issetGet()) {
            $arShopHistory = $this->payeer->getShopOrderInfo([
                'shopId' => env('id_shop'),
                'orderId' => $_GET['m_orderid'],
            ]);
            // 24.06.2022 18:26:54
            $id = $this->bot->fetch('payeer',['Id'=>$_GET['m_orderid']]);
            if (!isset($id['Many'])) {
                $this->bot->insert('payeer',['Id'=>$_GET['m_orderid'],'Bot'=>$this->bot->myBot()->id,'Many'=>$arShopHistory['info']['sumOut']]);
                return $arShopHistory['info']['sumOut'];
            }
        }
        return 0;
    }
    public function html($url, $Member, $price)
    {
        $m_shop = payeer['id_shop'];
        $m_orderid = rand(20, 250);
        $m_amount = number_format($price, 2, '.', '');
        $m_curr = 'USD';
        $m_desc = base64_encode("Team GULFBAR");
        $m_key = payeer['key_shop'];
        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        );
        $arHash[] = $m_key;

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));
        echo '<form method="post" action="https://payeer.com/merchant/">
            <input type="hidden" name="m_shop" value="'.$m_shop.'">
            <input type="hidden" name="m_orderid" value="'.$m_orderid.'">
            <input type="number" id="namber" class="form-control" readonly name="m_amount" value="'.$m_amount.'">
            <input type="hidden" name="m_curr" value="'.$m_curr.'">
            <input type="hidden" name="m_desc" value="'.$m_desc.'">
            <input type="hidden" name="m_sign" value="'.$sign.'">
            <div class="input-group mt-2">
            <input type="text" name="code" id="Copone" class="form-control" placeholder="كود الخصم">
            <span class="input-group-text" style="cursor: pointer;" id="code">تطبيق</span>
            </div>
            <input type="submit" name="m_process" value="دفع" class="btn btn-outline-success mt-2 px-4" id="pay" />
            <p class="text-start fs-5 mt-2">ملاحظة: أثناء عملية الدفع الخاصة بك فأنت موافق على <span class="text-primary text-decoration-underline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">الشروط والأحكام</span></p>
            </form>';
    }
    public function successPay()
    {
        $bot = $this->bot;
        $_SESSION['ok'] = true;
        if (isset($_SESSION['Products']) and !empty($_SESSION['Products'])) {
            $fetch = $bot->fetch('Products', ['Id' => $_SESSION['Products']]);
            $sql = $bot->fetch($bot->SelectData('member', 'Id="' . $_SESSION['Member'] . '"'));
            $txtAdmin = "مرحبا عزيزي الأدمن 🙋🏻 هناك عضو إشترى منتج 😉:\n";
            $txtAdmin .= "اشترى {$fetch['Name']}\n";
            $txtAdmin .= "معلومات العضو: ";
            $txtAdmin .= "ايدي العضو : `{$_SESSION['Member']}`\n";
            $txtAdmin .= "إيميله : `{$sql['Email']}`\n";
            $bot->sendAdmin($txtAdmin);
        } else if (isset($_SESSION['Market']) and !empty($_SESSION['Market'])) {
            $txtAdmin = "مرحبا عزيزي الأدمن 🙋🏻 هناك عضو إشتراك بالشركات التالية:\n";
            $sql = $bot->fetch($bot->SelectData('member', 'Id="' . $_SESSION['Member'] . '"'));
            $btn = json_decode($sql['Keybourd'], 1);
            $btn = array_map(function ($value) {
                return $value['text'];
            }, $btn);
            $array = [];
            foreach ($btn as $key => $value) {
                $fetch = $bot->fetch('Order', [
                    'Member' => $_SESSION['Member'],
                    'Shop' => strtoupper($value)
                ]);
                if (!isset($fetch['Id'])) {
                    $array[] = $value;
                    $EndTime = date('Y-n-d', (time() + (60 * 60 * 24 * 30)));
                    $LastEndTime = date('Y-n-d', (time() + (60 * 60 * 24 * 29)));
                    $bot->insert('Order', [
                        'Member' => $_SESSION['Member'],
                        'Shop' => strtoupper($value),
                        'EndTime' => $EndTime,
                        'LastEndTime' => $LastEndTime,
                    ]);
                }
            }
            $txtAdmin .= implode(' - ', $array) . "\n";
            $txtAdmin .= "معلومات العضو: ";
            $txtAdmin .= "ايدي العضو : `{$_SESSION['Member']}`\n";
            $bot->sendAdmin($txtAdmin);
            $bot->sendMessage($_SESSION['Member'], "مرحبا عزيزي 🙋🏻 تم تفعيل الشركات التالية:\n" . implode(' - ', $array), [], 0);
        }
    }
}
