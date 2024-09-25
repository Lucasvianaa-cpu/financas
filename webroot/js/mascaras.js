$(document).ready(function () {
    $('.date-single').inputmask({
        mask: '99999999',
        definitions: {
            '9': {
                validator: '[0-9]',
                cardinality: 1
            }
        },
        onBeforePaste: function (pastedValue) {
            return pastedValue.replace(/\D/g, '');
        }
    });

    $('.date-single').on('input', function () {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 7) {
            $(this).val(value.slice(0, 7));
        }
    });

    var timer;
    var input = $('.cpf_cnpj');

    input.on('input', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            aplicarMascara();
        }, 3000);
    });

    input.on('blur', function () {
        clearTimeout(timer);
        aplicarMascara();
    });

    input.on('keyup', function (event) {
        if (input.val() === '') {
            input.inputmask('remove');
        }
    });

    function aplicarMascara() {
        input.inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true,
            clearIncomplete: true
        });
    }

    $('.dinheiro').maskMoney({
        prefix: '',
        allowZero: true,
        allowNegative: false,
        thousands: '.',
        decimal: ','
    });

    let valorInput = $('.dinheiro').val();
    if (parseFloat(valorInput) > 0) {
        let valor = parseFloat(valorInput.replace(',', '.').replace(/^0+/, ''));
        if (isNaN(valor)) {
            valor = 0;
        }
        let valorFormatado = valor.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        $('.dinheiro').val(valorFormatado);
    }

    $('.date-single').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom',
        language: 'pt-BR'
    }).on('show', function (e) {
        adjustDatepickerPosition();
    });

    $(window).resize(function () {
        adjustDatepickerPosition();
    });

    function adjustDatepickerPosition() {
        var $datepicker = $('.datepicker.datepicker-dropdown');
        if ($datepicker.length > 0) {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var datepickerWidth = $datepicker.outerWidth();
            var datepickerHeight = $datepicker.outerHeight();
            var offset = $datepicker.offset();
            var left = offset.left;
            var top = offset.top;

            if (left + datepickerWidth > windowWidth) {
                left = windowWidth - datepickerWidth - 10; 
            }
            if (top + datepickerHeight > windowHeight) {
                top = windowHeight - datepickerHeight - 10; 
            }
            if (left < 0) {
                left = 10; 
            }
            if (top < 0) {
                top = 10;
            }

            $datepicker.css({
                'left': left + 'px',
                'top': top + 'px'
            });
        }
    }
});
