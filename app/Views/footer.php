<div class="footer text-muted text-center">
    © «Эко Налог» <yr id="toYear"></yr>. Все права защищены.
    <small id="loadingStat1" title="сервера"></small>&nbsp;
    <small id="loadingStat2" title="сеть"></small>&nbsp;
    <small id="loadingStat3" title="браузер"></small>

    <p class="small">
        <a href="#" target="_blank">согласие на обработку персональных данных</a> |
        <a href="#" target="_blank">условия пользовательского соглашения</a> |
        <a href="#" target="_blank">лицензионный договор присоединения</a> |
        <a href="#" target="_blank">политика в отношении обработки персональных данных</a>
    </p>
</div>



</div>
    <link href="/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/air-datepicker.css"/>
    <link href="/css/nice-number.min.css" rel="stylesheet">

    <script defer src="/js/core.js"></script>
    <script defer src="/js/toastr.min.js"></script>
    <script defer src="/js/elegant_admin.js"></script>
    <script defer src='/js/moment.min.js'></script>
    <script defer src="/js/moment-ru-locale.js"></script>
    <script defer src="/js/nice-number.min.js"></script>
    <script defer src="/js/air-datepicker.js"></script>
<script>
    // время загрузки страницы только при первоначальной  https://www.w3.org/TR/navigation-timing/timing-overview.png
    var hasBroeserTime = true;
    $(window).on('load', function() {
        setTimeout(function() {
            // console.log('вызов из window onload')
            writeTimingToFooter(window.performance.timing);
        }, 1000);
    });


    // пишет тайминги в футер
    // timingSource — откуда берем тайминги: в случае с аяксом работа браузера не учитывается
    function writeTimingToFooter(timingSource) {
    var networkTime = (timingSource.connectEnd - timingSource.fetchStart) + (timingSource.responseEnd - timingSource.responseStart);
    $('#loadingStat1').text( ((timingSource.responseStart - timingSource.requestStart) / 1000).toFixed(2) );
    $('#loadingStat2').text( (networkTime / 1000).toFixed(2));
    // $('#loadingStat2').text(((timingSource.loadEventEnd - timingSource.navigationStart) / 1000).toFixed(2));
    if (timingSource.domLoading !== undefined && timingSource.domComplete !== undefined)
    {
    $('#loadingStat3').text( ((timingSource.domComplete - timingSource.domLoading) / 1000).toFixed(2));
    }

    if (!hasBroeserTime) $('#loadingStat3').text('≈');

    }
</script>
</body>
</html>
