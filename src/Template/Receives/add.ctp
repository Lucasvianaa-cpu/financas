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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $this->Url->build(['controller' => 'Receives', 'action' => 'index']); ?>">Visualizar Contas a Receber</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adicionar Contas a Receber</li>
        </ol>
    </nav>
    <div class="col-12 mb-4">
        <div class="card border shadow-xs h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 col-9">
                        <h6 class="mb-0 font-weight-semibold text-lg">Adicionar Contas a Receber</h6>
                        <p class="text-sm mb-1">Preencha os campos abaixo</p>
                    </div>
                    <div class="">
                        <?= $this->Form->create($receife, ['class' => 'row g-3']) ?>
                        <form class="row g-3">
                            <div class="col-12">
                                <?= $this->Form->control('description', ['type' => 'text', 'label' => 'Descrição', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite a descrição da conta']); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->control('value', ['type' => 'text', 'label' => 'Valor', 'class' => 'form-control dinheiro', 'required' => 'required']); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->data_personalizada('date_receive', 'Data de Recebimento', 'date', 'dd/mm/yyyy', 'required', $receife->date_receive); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->control('status', [
                                    'type' => 'select',
                                    'label' => 'Status',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'options' => [
                                        false => 'Pendente',
                                        true => 'Recebido'
                                    ],
                                    'default' => false
                                ]); ?>
                            </div>

                            <div class="col-md-2 pb-3">
                                <?= $this->Form->control('category_id', ['type' => 'select', 'label' => 'Categoria', 'options' => $categories, 'class' => 'form-select', 'required' => 'required', 'placeholder' => 'Selecione a Categoria']); ?>
                            </div>
                            <div class="col-2 checkbox-input">
                                <label for="" class="form-label"></label>
                                <div class="form-check mt-2 mb-5">
                                    <?= $this->Form->control('is_recurring', [
                                        'type' => 'checkbox',
                                        'label' => 'Recorrente?',
                                        'class' => 'form-check-input',
                                        'title' => 'Marque se este recebimento será constante na mesma data.',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-bs-placement' => 'top',
                                        'escape' => false 
                                    ]); ?>
                                </div>
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