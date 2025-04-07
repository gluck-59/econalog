<h1>footer</h1>
<script>
    toastr.options.timeOut = 6000;toastr.options.closeButton = false;toastr.options.progressBar = true;
    /** Force toastr.error to be sticky */
    toastr.error_ = toastr.error;
    toastr.error = function(a,b,c){
        var t = toastr.options.timeOut;
        toastr.options.timeOut = 20000;
        toastr.error_(a,b,c);
        toastr.options.timeOut = t;
    };


    moment.locale(window.navigator.language);
    $('yr#toYear').text(moment().format("YYYY"));
    $.datepicker.setDefaults($.datepicker.regional["ru"]);

    doMoment();
    $('.btn-tooltip').tooltip();

    jQuery.fn.extend({
        autoHeight: function () {
            function autoHeight_(element) {
                return jQuery(element)
                    .css({ 'height': 'auto', 'overflow-y': 'hidden' })
                    .height(element.scrollHeight);
            }
            return this.each(function() {
                autoHeight_(this).on('input', function() {
                    autoHeight_(this);
                });
            });
        }
    });
</script>

<script src="/js/elegant_admin.js"></script>
<script src='/include/js/moment.min.js'></script>
<script src="/include/js/moment-ru-locale.js"></script>
<script src='/include/js/pnotify.custom.min.js'></script>
<script src=//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js></script>

<script src="/include/libs/air-datepicker/datepicker.js"></script>
<link rel="stylesheet" href="/include/libs/air-datepicker/datepicker.css"/>
<script src="/include/libs/jquery.nice-number/jquery.nice-number.js"></script>
<link href="/include/libs/jquery.nice-number/jquery.nice-number.css" rel="stylesheet">

<link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel="stylesheet"></script>


</body>
</html>
