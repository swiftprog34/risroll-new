<!--noindex-->
<!--googleoff: index-->
@if(!session()->has('need_choose_city'))
<div id="cookie_notification">
    <p>Для улучшения работы сайта и его взаимодействия с пользователями мы используем файлы cookie. Продолжая работу с
        сайтом, Вы разрешаете использование cookie-файлов. Вы всегда можете отключить файлы cookie в настройках Вашего
        браузера.</p>
    <button class="button cookie_accept">Принять</button>
</div>
<!--googleon: index-->
<!--/noindex-->
<script>
    function checkCookies() {
        let cookieDate = localStorage.getItem('cookieDate');
        let cookieNotification = document.getElementById('cookie_notification');
        let cookieBtn = cookieNotification.querySelector('.cookie_accept');

        // Если записи про кукисы нет или она просрочена на 1 год, то показываем информацию про кукисы
        if (!cookieDate || (+cookieDate + 31536000000) < Date.now()) {
            cookieNotification.classList.add('show');
        }

        // При клике на кнопку, в локальное хранилище записывается текущая дата в системе UNIX
        cookieBtn.addEventListener('click', function () {
            localStorage.setItem('cookieDate', Date.now());
            cookieNotification.classList.remove('show');
        })
    }

    checkCookies();
</script>
@endif
