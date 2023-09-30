@include('client.components.head')
<body>
<div class="theme">
    @include('client.components.header')
<main class="container animated fadeIn">

    <div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="Главная" href="{{route('index', ['city' => session('city')])}}">
                    <span itemprop="name">Главная</span>
                    <meta itemprop="position" content="1">
                </a>
            </span>
        ->
        <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <a itemprop="item" title="" href="{{route('privacy', ['city' => session('city')])}}">
                    <span itemprop="name">Политика конфиденциальности</span>
                    <meta itemprop="position" content="2">
                </a>
            </span>
    </div>

    <div class="page_text">
        <h1>Политика конфиденциальности</h1>
    </div>

    <div class=" pages">

        <p>Настоящая Политика конфиденциальности персональных данных (далее – Политика конфиденциальности) действует в отношении всей информации, которую Пользователь может получить во время использования Приложения.</p>


        <h2>1. Определение терминов</h2>

        <p>1.1 В настоящей Политике конфиденциальности используются следующие термины:</p>

        <p>1.1.1.	«Администрация мобильного приложения и/или веб-сайта (далее – Администрация) » – уполномоченные сотрудники на управление мобильным приложением и/или веб-сайтом (далее - Приложение), действующие от имени <span>Супер доставка Project</span>, которые организуют и (или) осуществляют обработку персональных данных, а также определяют цели обработки персональных данных, состав персональных данных, подлежащих обработке, действия (операции), совершаемые с персональными данными.</p>

        <p>1.1.2. «Персональные данные» - любая информация, прямо или косвенно относящаяся к определенному или определяемому физическому лицу (субъекту персональных данных).</p>

        <p>1.1.3. «Обработка персональных данных» - любое действие (операция) или совокупность действий (операций), совершаемых с использованием средств автоматизации или без использования таких средств с персональными данными, включая сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, передачу (распространение, предоставление, доступ), обезличивание, блокирование, удаление, уничтожение персональных данных.</p>

        <p>1.1.4. «Конфиденциальность персональных данных» - обязательное для соблюдения Оператором или иным получившим доступ к персональным данным лицом требование не допускать их распространения без согласия субъекта персональных данных или наличия иного законного основания.</p>

        <p>1.1.5. «Пользователь сайта Интернет-магазина (далее ? Пользователь)» – лицо, имеющее доступ к Сайту, посредством сети Интернет и использующее Сайт интернет-магазина.</p>

        <p>1.1.6. «Cookies» — небольшой фрагмент данных, отправленный веб-сервером и хранимый на компьютере пользователя, который веб-клиент или веб-браузер каждый раз пересылает веб-серверу в HTTP-запросе при попытке открыть страницу соответствующего сайта.</p>

        <p>1.1.7. «IP-адрес» — уникальный сетевой адрес узла в компьютерной сети, построенной по протоколу IP.</p>




        <h2>2. Общие положения</h2>

        <p>2.1. Использование Пользователем сайта Интернет-магазина означает согласие с настоящей Политикой конфиденциальности и условиями обработки персональных данных Пользователя.</p>
        <p>2.2. В случае несогласия с условиями Политики конфиденциальности Пользователь должен прекратить использование сайта Интернет-магазина.</p>
        <p>2.3.Настоящая Политика конфиденциальности применяется только к Приложению <span>Доставка</span>. Интернет-магазин не контролирует и не несет ответственность за сайты/приложения третьих лиц, на которые Пользователь может перейти по ссылкам, доступным в приложении.</p>
        <p>2.4. Администрация сайта не проверяет достоверность персональных данных, предоставляемых Пользователем Приложения.</p>










        <h2>3. Предмет политики конфиденциальности</h2>

        <p>3.1. Настоящая Политика конфиденциальности устанавливает обязательства Администрации Приложения по неразглашению и обеспечению режима защиты конфиденциальности персональных данных, которые Пользователь предоставляет по запросу Администрации Приложения при регистрации в Приложении или при оформлении заказа для приобретения Товара.</p>
        <p>3.2. Персональные данные, разрешённые к обработке в рамках настоящей Политики конфиденциальности, предоставляются Пользователем путём заполнения формы регистрации в Приложении <span>Доставка</span> И заполнения данных в разделе Корзина для оформления заказа, и включают в себя следующую информацию:</p>
        <p>3.2.1. имя, отчество Пользователя;</p>
        <p>3.2.2. контактный телефон Пользователя;</p>
        <p>3.2.3. адрес электронной почты (e-mail);</p>
        <p>3.2.4. адрес доставки Товара;</p>
        <p>3.2.5. место жительства Пользователя.</p>

        <p>3.3. Интернет-магазин защищает Данные, которые автоматически передаются в процессе просмотра рекламных блоков и при посещении страниц, на которых установлены статистические скрипты сервисов Yandex и Google (Яндекс.Метрика, Google.Аналитика):</p>
        <ul>
            <li>IP адрес;</li>
            <li>информация из cookies;</li>
            <li>информация о браузере (или иной программе, которая осуществляет доступ к показу рекламы);</li>
            <li>время доступа;</li>
            <li>адрес страницы, на которой расположен рекламный блок;</li>
            <li>реферер (адрес предыдущей страницы).</li>
        </ul>

        <p>3.3.1. Отключение cookies может повлечь невозможность доступа к частям Приложения, требующим авторизации.</p>
        <p>3.3.2. Интернет-магазин осуществляет сбор статистики об IP-адресах своих посетителей. Данная информация используется с целью выявления и решения технических проблем, для контроля законности проводимых финансовых платежей.</p>
        <p>3.4. Любая иная персональная информация неоговоренная выше (история заказов/покупок, используемые браузеры и операционные системы и т.д.) подлежит надежному хранению и нераспространению, за исключением случаев, предусмотренных в п.п. 5.2. и 5.3. настоящей Политики конфиденциальности.</p>






        <h2>4. Цели сбора персональной информации пользователя</h2>

        <p>4.1. Персональные данные Пользователя Администрация Приложения может использовать в целях:</p>
        <p>4.1.1. Идентификации Пользователя, зарегистрированного в Приложении, для оформления заказа и (или) заключения Договора купли-продажи товара дистанционным способом с <span>Доставка</span>.</p>
        <p>4.1.2. Предоставления Пользователю доступа к персонализированным ресурсам Приложения.</p>
        <p>4.1.3. Установления с Пользователем обратной связи, включая направление уведомлений, запросов, касающихся использования Приложения, оказания услуг, обработка запросов и заявок от Пользователя.</p>
        <p>4.1.4. Определения места нахождения Пользователя для обеспечения безопасности, предотвращения мошенничества.</p>
        <p>4.1.5. Подтверждения достоверности и полноты персональных данных, предоставленных Пользователем.</p>
        <p>4.1.6. Создания учетной записи для совершения покупок, если Пользователь дал согласие на создание учетной записи.</p>
        <p>4.1.7. Уведомления Пользователя Приложения о состоянии Заказа.</p>
        <p>4.1.8. Предоставления Пользователю эффективной клиентской и технической поддержки при возникновении проблем связанных с использованием Приложения.</p>
        <p>4.1.9. Предоставления Пользователю с его согласия, обновлений продукции, специальных предложений, информации о ценах, новостной рассылки и иных сведений от имени <span>Супер доставка Project</span> или от имени его партнеров.</p>
        <p>4.1.10. Осуществления рекламной деятельности с согласия Пользователя.</p>
        <p>4.1.11. Предоставления доступа Пользователю на сайты или сервисы партнеров <span>Супер доставка Project</span> с целью получения продуктов, обновлений и услуг.</p>








        <h2>5. Способы и сроки обработки персональной информации</h2>

        <p>5.1. Обработка персональных данных Пользователя осуществляется без ограничения срока, любым законным способом, в том числе в информационных системах персональных данных с использованием средств автоматизации или без использования таких средств.</p>
        <p>5.2. Пользователь соглашается с тем, что Администрация Приложения вправе передавать персональные данные третьим лицам, в частности, курьерским службам, организациям почтовой связи, операторам электросвязи, исключительно в целях выполнения заказа Пользователя, оформленного в Приложении <span>ресторан</span> «<span>Супер доставка Project</span>», включая доставку Товара.</p>
        <p>5.3. Персональные данные Пользователя могут быть переданы уполномоченным органам государственной власти Российской Федерации только по основаниям и в порядке, установленном законодательством Российской Федерации.</p>
        <p>5.4. При утрате или разглашении персональных данных Администрация Приложения информирует Пользователя об утрате или разглашении персональных данных.</p>
        <p>5.5. Администрация Приложения принимает необходимые организационные и технические меры для защиты персональной информации Пользователя от неправомерного или случайного доступа, уничтожения, изменения, блокирования, копирования, распространения, а также от иных неправомерных действий третьих лиц.</p>
        <p>5.6. Администрация Приложения совместно с Пользователем принимает все необходимые меры по предотвращению убытков или иных отрицательных последствий, вызванных утратой или разглашением персональных данных Пользователя.</p>









        <h2>6. Обязательства сторон</h2>

        <p><strong>6.1. Пользователь обязан:</strong></p>

        <p>6.1.1. Предоставить информацию о персональных данных, необходимую для пользования Приложением <span>ресторан</span></p>

        <p>6.1.2. Обновить, дополнить предоставленную информацию о персональных данных в случае изменения данной информации.</p>

        <p><strong>6.2. Администрация Приложения обязана:</strong></p>

        <p>6.2.1. Использовать полученную информацию исключительно для целей, указанных в п. 4 настоящей Политики конфиденциальности.</p>

        <p>6.2.2. Обеспечить хранение конфиденциальной информации в тайне, не разглашать без предварительного письменного разрешения Пользователя, а также не осуществлять продажу, обмен, опубликование, либо разглашение иными возможными способами переданных персональных данных Пользователя, за исключением п.п. 5.2. и 5.3. настоящей Политики Конфиденциальности.</p>

        <p>6.2.3. Принимать меры предосторожности для защиты конфиденциальности персональных данных Пользователя согласно порядку, обычно используемого для защиты такого рода информации в существующем деловом обороте.</p>

        <p>6.2.4. Осуществить блокирование персональных данных, относящихся к соответствующему Пользователю, с момента обращения или запроса Пользователя или его законного представителя либо уполномоченного органа по защите прав субъектов персональных данных на период проверки, в случае выявления недостоверных персональных данных или неправомерных действий.</p>









        <h2>7. Ответственность сторон</h2>

        <p>7.1. Администрация сайта, не исполнившая свои обязательства, несёт ответственность за убытки, понесённые Пользователем в связи с неправомерным использованием персональных данных, в соответствии с законодательством Российской Федерации, за исключением случаев, предусмотренных п.п. 5.2., 5.3. и 7.2. настоящей Политики Конфиденциальности.</p>

        <p>7.2. В случае утраты или разглашения Конфиденциальной информации Администрация сайта не несёт ответственность, если данная конфиденциальная информация:</p>

        <p>7.2.1. Стала публичным достоянием до её утраты или разглашения.</p>

        <p>7.2.2. Была получена от третьей стороны до момента её получения Администрацией сайта.</p>

        <p>7.2.3. Была разглашена с согласия Пользователя.</p>





        <h2>8. Разрешение споров</h2>

        <p>8.1. До обращения в суд с иском по спорам, возникающим из отношений между Пользователем Приложения <span>ресторан</span> и Администрацией Приложения, обязательным является предъявление претензии (письменного предложения о добровольном урегулировании спора).</p>

        <p>8.2 .Получатель претензии в течение 30 календарных дней со дня получения претензии, письменно уведомляет заявителя претензии о результатах рассмотрения претензии.</p>

        <p>8.3. При не достижении соглашения спор будет передан на рассмотрение в судебный орган в соответствии с действующим законодательством Российской Федерации.</p>

        <p>8.4. К настоящей Политике конфиденциальности и отношениям между Пользователем и Администрацией сайта применяется действующее законодательство Российской Федерации.</p>







        <h2>9. Дополнительные условия</h2>

        <p>9.1. Администрация сайта вправе вносить изменения в настоящую Политику конфиденциальности без согласия Пользователя.</p>

        <p>9.2. Новая Политика конфиденциальности вступает в силу с момента ее размещения в Приложении, если иное не предусмотрено новой редакцией Политики конфиденциальности.</p>

        <p>9.3. Все предложения или вопросы по настоящей Политике конфиденциальности следует сообщать в письменном виде на емейл: <span>mymail@mail.ru</span>.</p>

        <p>9.4. Действующая Политика конфиденциальности размещена на странице по адресу <span>http://ris72.ru/page_privacy.php</span>.</p>



        <div class="indent"></div>
    </div>
</main>
@include('client.components.footer')
</div>
<script src="/client/lib/animate_add.js" async></script>
<!---->
@include('client.components.totop')
<!--end-->
@include('client.components.close_win')
@include('client.components.cookies_check')
</body>
</html>
@include('client.components.readmore')
<!---->