<?php 

$template = "\n\n
            A T&C Document\n\n
			This document is made of plaintext.\n\n
			Is made of [CLAUSE-3].\n\n
			Is made of [CLAUSE-4].\n\n
			Is made of [SECTION-1].\n\n
			Your legals.";


$dataset = [
    'clauses' => [
        ['id' => 1, 'text' => 'The quick brown fox'],
        ['id' => 2, 'text' => 'jumps over the lazy dog'],
        ['id' => 3, 'text' => 'And dies'],
        ['id' => 4, 'text' => 'The white horse is white']
    ],
    'sections' => [
        ['id' => 1, 'clauses_ids' => [1, 2]] 
    ]
];


echo $template;

