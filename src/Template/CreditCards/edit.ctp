<style>
    .checkbox-input label {
        font-size: 0.875rem;
        font-weight: 400;
        cursor: pointer;
    }
</style>

<div class="container-fluid my-2 py-3">
    <nav aria-label="breadcrumb" style="margin-bottom: 20px; margin-top: -50px;">
        <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $this->Url->build(['controller' => 'CreditCards', 'action' => 'index']); ?>">Visualizar Cartões de Crédito</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Editar Cartão de Crédito</li>
        </ol>
    </nav>
    <div class="col-12 mb-4">
        <div class="card border shadow-xs h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 col-9">
                        <h6 class="mb-0 font-weight-semibold text-lg">Editar Cartão de Crédito</h6>
                        <p class="text-sm mb-1">Preencha os campos abaixo</p>
                    </div>
                    <div class="">
                        <?= $this->Form->create($creditCards, ['class' => 'row g-3']) ?>
                        <form class="row g-3">
                            <div class="col-12">
                                <?= $this->Form->control('name', ['type' => 'text', 'label' => 'Nome', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite o nome do cartão']); ?>
                            </div>
                            <div class="col-6">
                                <?= $this->Form->control('operator', ['type' => 'text', 'label' => 'Inst. Financeira', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Ex: MasterCard']); ?>
                            </div>
                            <div class="col-6 mb-5">
                                <?= $this->Form->control('credit_limit', ['type' => 'text', 'label' => 'Limite do Cartão', 'class' => 'form-control dinheiro', 'required' => 'required', 'placeholder' => 'Digite o limite do cartão']); ?>
                            </div>

                            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">

                                <?= $this->Form->button(__('Enviar'), ['class' => 'btn btn-sm btn-dark']) ?>
                                <a class="btn btn-sm btn-white" href="<?= $this->Url->build(['action' => 'index']); ?>">Cancelar</a>
                            </div>
                            <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>