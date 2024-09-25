<div class="container-fluid py-4 px-5">
    <nav aria-label="breadcrumb" style="margin-bottom: 20px; margin-top: -50px;">
        <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>">Dashboard</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Contas a Receber</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Contas a Receber</h6>
                            <p class="text-sm">Estes são as contas a receber cadastradas...</p>
                        </div>

                        <div style="text-align: right;">
                            <a class="nav-link " href="<?= $this->Url->build(['controller' => 'Receives', 'action' => 'add']) ?>" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" class="ionicon" viewBox="0 0 512 512">
                                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 176v160M336 256H176" />
                                </svg>
                                <span class="nav-link-text ms-1">Adicionar Conta a Receber</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="border-bottom py-3 px-3 align-items-center">
                        <?php echo $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3', 'filtro']); ?>


                        <div class="col-12 col-md-3 mb-2">
                            <?= $this->Form->control('status', ['type' => 'select', 'label' => 'Status', 'class' => 'form-control', 'default' => $this->request->getQuery('status'), 'empty' => [3 => 'Todos'], 'options' => [1 => 'Pagos', 2 => 'Pendentes', 3 => 'Todos']]); ?>
                        </div>

                        <div class="col-12 col-md-3 mb-2">
                        <?= $this->Form->data_personalizada('data_recebimento', 'Data de Recebimento:', 'date', 'dd/mm/yyyy', 'optional', $this->request->getQuery('data_recebimento')); ?>
                        </div>
                        
                        <div class="col-12 col-md-3 mb-2">
                            <?= $this->Form->control('descricao', ['class' => 'form-control', 'label' => 'Busque pela descrição:', 'default' => $this->request->getQuery('descricao'), 'placeholder' => 'Digite a descrição']); ?>
                        </div>

                        <button type="submit" class="btn btn-sm btn-dark col-12 col-md-3 mb-2" style="margin-top: 46px; height: 40px;">
                            <b>Buscar </b>&nbsp;<i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>

                        <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Cód</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Descrição</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Valor</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Data Recebimento</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Status</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Categoria</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Recorrência</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($receives as $receive) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex align-items-center">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold"> <?= $receive->id ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm text-dark font-weight-semibold mb-0"><?= $receive->description ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm text-dark font-weight-semibold mb-0"><?= 'R$ ' . number_format($receive->value, 2, ',', '.'); ?>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                <?= $receive->date_receive->format('d/m/Y') ?>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <?php if ($receive->status == true): ?>
                                                <span class="badge badge-sm border border-success text-success bg-success">
                                                    <svg width="9" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" class="me-1">
                                                        <path d="M1 4.42857L3.28571 6.71429L9 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    Recebido
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-sm border border-warning text-warning bg-warning">
                                                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="me-1ca">
                                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Pendente
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <p class="text-sm text-dark font-weight-semibold mb-0"><?= h($receive->category->name) ?></p>
                                        </td>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <p class="text-sm text-dark font-weight-semibold mb-0"><?= $receive->is_recurring == true ? 'Sim' : 'Não' ?></p>
                                        </td>
                                        <td class="align-middle text-center" style="display: flex; justify-content: end;">
                                            <a class="btn btn-sm btn-dark" href="<?= $this->Url->build(['controller' => 'Receives', 'action' => 'edit', $receive->id]); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            <?= $this->Form->postLink(
                                                '<button type="button" class="btn btn-sm btn-dark mx-1">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                  </svg>
                              </button>',
                                                ['action' => 'delete', $receive->id],
                                                [
                                                    'confirm' => __('Tem certeza que deseja deletar a conta: {0}?', $receive->description),
                                                    'escapeTitle' => false,
                                                    'escape' => false,
                                                    'form' => ['style' => 'display:inline'],
                                                ]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>



                    </div>

                    <div class="text-center mx-3 d-flex flex-row align-items-center justify-content-between m-2">
                        <p class="font-weight-semibold mb-0 text-dark text-sm"><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')]) ?></p>
                        <ul class="pagination d-flex align-items-center">
                            <span aria-hidden="true" class="border rounded-2 p-2 mx-1 bg-dark d-flex align-items-center" style="height: 30px"><?= $this->Paginator->prev('' . __('<span class="text-white" style="font-size: 20px">&laquo;</span>'), ['escape' => false, 'class' => 'prev']) ?></span>
                            <span aria-hidden="true" class="border rounded-2 p-2 bg-dark d-flex align-items-center" style="height: 30px"><?= $this->Paginator->next(__('<span class="text-white" style="font-size: 20px">&raquo;</span>') . ' ', ['escape' => false, 'class' => 'next']) ?></span>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer pt-3">
            <div class="container-fluid d-flex justify-content-center">
                <div class="row">
                    <div class="col-lg-12 mb-lg-0 mb-4 text-center">
                        <div class="copyright text-xs text-muted text-lg-start">
                            Desenvolvido por Lucas Viana - Copyright © <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>