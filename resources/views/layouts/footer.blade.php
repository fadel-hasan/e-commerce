<footer id="footer">
    <section class="grid-helper">
        <div>
            <h4>صفحات مهمة</h4>
            <nav>
                <a href="{{ route('privacyPolicy') }}">سياسة الخصوصية</a>
                <a href="{{ route('termsOfUse') }}">شروط الإستخدام</a>
                <a href="{{ route('refundOfFunds') }}">سياسة رد الأموال</a>
            </nav>
        </div>
        <div>
            <h4>الأقسام</h4>
            <nav>
                <a href="{{ route('user.category',['uri'=>"test"]) }}">سيرفرات</a>
                <a href="{{ route('user.category',['uri'=>"test"]) }}">سكريتات</a>
                <a href="{{ route('user.category',['uri'=>"test"]) }}">شدات</a>
            </nav>
        </div>
        <div>
            <h4>تابعنا</h4>
            <nav class="links">
                <a href="https://facebook.com/{{ \App\Http\Controllers\Site\VarController::getSitting('facebook') }}">
                    <i class="fa-brands fa-facebook fa-3x"></i>
                </a>
                <a href="https://twitter.com/{{ \App\Http\Controllers\Site\VarController::getSitting('twitter') }}">
                    <i class="fa-brands fa-x-twitter fa-3x"></i>
                </a>
                <a href="{{ \App\Http\Controllers\Site\VarController::getSitting('telegram') }}">
                    <i class="fa-brands fa-telegram fa-3x"></i>
                </a>
                <a href="{{ \App\Http\Controllers\Site\VarController::getSitting('website') }}" class="site">
                    <i class="fa-solid fa-globe fa-3x"></i>
                </a>
                <a href="{{ \App\Http\Controllers\Site\VarController::getSitting('instagram') }}">
                    <i class="fa-brands fa-instagram fa-3x"></i>
                </a>
            </nav>
        </div>
    </section>
    <p class="mt-6 pt-2 border-t">جميع الحقوق محفوظة &copy; لـ <span>اسم الموقع</span></p>
</footer>
