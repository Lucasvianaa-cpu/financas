<?php

namespace App\View\Helper;

use Cake\View\Helper\FormHelper;
use DateTime;

class Form2Helper extends \Cake\View\Helper\FormHelper {

    public function data_personalizada($nome, $label, $tipo, $placeholder, $required, $valor) {
        $nome_convertido = str_replace('_', '-', $nome);

        if ($tipo === 'date') {
            $valor_formatado = $this->formatarDataParaInputDate($valor);
        } else {
            $valor_formatado = $valor;
        }

        echo '
            <label for="' . $nome_convertido . '" class="form-label">' . $label . '</label>
            <input type="' . $tipo . '" class="form-control" id="' . $nome_convertido . '" name="' . $nome . '" value="' . $valor_formatado . '" placeholder="' . $placeholder . '" ' . ($required ? 'required' : '') . '>
        ';
    }

    private function formatarDataParaInputDate($data) {
        try {
            $date = new DateTime($data);
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            return '';
        }
    }
}
