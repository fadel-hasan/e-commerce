<h2 class="title-table">Payeer</h2>
@php
    $m_shop = env('id_shop');
    $m_orderid = $order_id;
    $m_amount = number_format($price, 2, '.', '');
    $m_curr = 'USD';
    $m_desc = base64_encode('Id order is: '.$order_id);
    $m_key = env('key_shop');
    $arHash = [$m_shop, $m_orderid, $m_amount, $m_curr, $m_desc];
    $arHash[] = $m_key;
    $sign = strtoupper(hash('sha256', implode(':', $arHash)));
@endphp
<form method="post" action="https://payeer.com/merchant/" class="sitting">
    <input type="hidden" name="m_shop" value="{{ $m_shop }}">
    <input type="hidden" name="m_orderid" value="{{ $m_orderid }}">
    <input type="hidden" id="number" readonly name="m_amount" value="{{ $m_amount }}" readonly>
    <input type="hidden" name="m_curr" value="{{ $m_curr }}">
    <input type="hidden" name="m_desc" value="{{ $m_desc }}">
    <input type="hidden" name="m_sign" value="{{ $sign }}">
    <input type="submit" name="m_process" value="دفع" class="button-blue mt-2 px-16 py-1 mx-auto" id="pay" />
    <script>
        document.getElementById('pay').click();
    </script>
</form>
