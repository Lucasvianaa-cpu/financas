<div class="container-fluid my-2 py-3">
    <nav aria-label="breadcrumb" style="margin-bottom: 20px; margin-top: -50px;">
        <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $this->Url->build(['controller' => 'ShoppingCards', 'action' => 'index']); ?>">Visualizar Compras Realizadas</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adicionar Compras em Cartões</li>
        </ol>
    </nav>
    <div class="col-12 mb-4">
        <div class="card border shadow-xs h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 col-9">
                        <h6 class="mb-0 font-weight-semibold text-lg">Adicionar Compras em Cartões</h6>
                        <p class="text-sm mb-1">Preencha os campos abaixo</p>
                    </div>
                    <div class="">
                        <?= $this->Form->create($shoppingCard, ['class' => 'row g-3']) ?>
                        <form class="row g-3">
                            <div class="col-12 col-md-8 mb-2">
                                <?= $this->Form->control('description', ['type' => 'text', 'label' => 'Nome', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite a descrição da compra']); ?>
                            </div>

                            <div class="col-md-4">
                                <?= $this->Form->data_personalizada('date_shopping', 'Data da Compra', 'date', 'dd/mm/yyyy', 'required', $shoppingCard->date_shopping); ?>
                            </div>

                            <div class="col-12 col-md-6 mb-2 ">
                                <?= $this->Form->control('value_total', ['type' => 'text', 'label' => 'Valor da Compra', 'class' => 'form-control dinheiro', 'required' => 'required', 'placeholder' => 'Digite o valor da compra']); ?>
                            </div>

                            <div class="col-md-4 pb-3">
                                <?= $this->Form->control('credit_card_id', ['type' => 'select', 'label' => 'Selecione o cartão', 'options' => $credit_cards, 'class' => 'form-select', 'required' => 'required']); ?>
                            </div>

                            <div class="col-12 col-md-2 mb-2 checkbox-input">
                                <label for="" class="form-label"></label>
                                <div class="form-check mt-2 mb-5">
                                    <?= $this->Form->control('is_parcel', ['type' => 'checkbox', 'label' => 'Foi Parcelado?', 'class' => 'form-check-input', 'id' => 'is-parcel']); ?>
                                </div>
                            </div>

                            <div class="col-4" id="parcel-number-field" style="display: none;">
                                <?= $this->Form->control('parcel_number', ['type' => 'number', 'label' => 'Nº de Parcelas', 'class' => 'form-control', 'placeholder' => 'Digite o n° de parcelas']); ?>
                            </div>
                            <div class="col-6" id="value-parcel-field" style="display: none;">
                                <?= $this->Form->control('value_parcel_simbolico', ['type' => 'text', 'label' => 'Valor de cada Parcela', 'class' => 'form-control dinheiro', 'style' => 'pointer-events: none;', 'placeholder' => 'Digite o valor de cada parcela']); ?>
                                <?= $this->Form->hidden('valor_parcela', ['id' => 'valor-parcela']); ?>
                            </div>

                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto text-sm-end">
                        <?= $this->Form->button(__('Enviar'), ['class' => 'btn btn-sm btn-dark']) ?>
                        <a class="btn btn-sm btn-white" href="<?= $this->Url->build(['action' => 'index']); ?>">Cancelar</a>
                    </div>
                    <?= $this->Form->end() ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        function toggleParcelFields() {
            if ($('#is-parcel').is(':checked')) {
                $('#parcel-number-field').show();
                $('#value-parcel-field').show();
            } else {
                $('#parcel-number-field').hide();
                $('#value-parcel-field').hide();
            }
        }

        toggleParcelFields();

        $('#is-parcel').change(function() {
            toggleParcelFields();
        });
    });
</script>
<script>
    $('#parcel-number').on('input', function() {
        this.value = this.value.replace(/[^\d]/g, '');
    });

    function monitoryAlters() {
        var valor = $('#value-total').val();
        var valorFormatado = valor.replace(/\./g, '').replace(',', '.');
        var valorNumerico = parseFloat(valorFormatado);

        var quantidade = parseInt($('#parcel-number').val());
        var valor_parcela = 0;

        if (valorNumerico > 0) {
            if (quantidade === 0 || isNaN(quantidade)) {
                quantidade = 1;
            }

            valor_parcela = truncateValue(valorNumerico / quantidade);

            var valorParcelaFormatado = valor_parcela.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            $('#value-parcel-simbolico').val(valorParcelaFormatado);
            $('#valor-parcela').val(valor_parcela);

        }
    }
    function truncateValue(valor) {
        return Math.floor(valor * 100) / 100;
    }


    $('#parcel-number, #value-total').on('input change keyup', function() {
        monitoryAlters();
    });
</script>