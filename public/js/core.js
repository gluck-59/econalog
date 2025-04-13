$(document).ready(function () {
console.log('document ready');
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


    // $.datepicker.setDefaults($.datepicker.regional["ru"]); // ??
    $("#date").datepicker({
        autoClose: true,
        dateFormat: 'dd.mm.yy'
    });


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
    doMoment();



// $('.btn-tooltip').tooltip();
    $('textarea').autoHeight();

    let showSidebar = localStorage.getItem('showSidebar') ? localStorage.getItem('showSidebar') : 1;
    if (showSidebar == 1) {
        $("body").addClass("lock-nav");
    } else {
        $("body").removeClass("lock-nav");
    }
}); // document.ready











function doMoment() {
    $('[data-time]').each(function() {
        if (this.dataset.time != '' && this.dataset.time != 'null') {
            let format;

            if (this.dataset.timeformat === 'undefined') {
                format = 'll';
            } else format = this.dataset.timeformat;

            let timeToShow = moment.unix(this.dataset.time).format(format);

            if ($(this).is('input')) {
                $(this).val(timeToShow);
            } else {
                $(this).html(timeToShow);
            }
        }
    });
}