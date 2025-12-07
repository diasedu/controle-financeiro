<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $vendas_itens = [
        'venda_id' => [
            'rules'  => 'required|is_natural_no_zero',
            'errors' => [
                'required'             => 'Venda obrigatória.',
                'is_natural_no_zero'   => 'Venda inválida.',
            ],
        ],

        'produto_id' => [
            'rules'  => 'required|is_natural_no_zero',
            'errors' => [
                'required'             => 'Produto obrigatório.',
                'is_natural_no_zero'   => 'Produto inválido.',
            ],
        ],

        'quantidade' => [
            'rules'  => 'required|is_natural_no_zero',
            'errors' => [
                'required'           => 'Quantidade obrigatória.',
                'is_natural_no_zero' => 'Quantidade deve ser maior que zero.',
            ],
        ],
    ];
}
