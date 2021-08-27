<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Form Tools',
    'description' => 'Collection of tools for TYPO3s EXT:form',
    'category' => 'plugin',
    'author' => 'Stefan Froemken',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '1.0.5',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.3-10.4.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
