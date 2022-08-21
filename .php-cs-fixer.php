<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PHP81Migration'                       => true,
    'binary_operator_spaces'                => [
        'operators' => [
            '=>' => 'align_single_space'
        ]
    ],
    'curly_braces_position'                 => [
        'control_structures_opening_brace' => 'next_line_unless_newline_at_signature_end'
    ],
    'no_useless_else'                       => true,
    'no_trailing_comma_in_singleline_array' => true,
    'blank_line_before_statement' => [
        'statements' => [
            'return'
        ]
    ]
];

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php');

return (new Config())
    ->setUsingCache(false)
    ->setFinder($finder)
    ->setRules($rules);
