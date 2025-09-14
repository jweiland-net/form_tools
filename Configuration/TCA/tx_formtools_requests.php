<?php

defined('TYPO3') or die;

return [
    'ctrl' => [
        'title' => 'Stored Forms',
        'label' => 'email',
        'label_alt' => 'last_name, first_name',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY tstamp DESC',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'first_name, last_name, telephone, address, city, email, message, xml',
        'iconfile' => 'EXT:form_tools/Resources/Public/Icons/tx_formtools_requests.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, last_name, telephone, address, city, email, message, xml,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, 
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access',
        ],
    ],
    'palettes' => [
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_formtools_requests',
                'foreign_table_where' => 'AND tx_formtools_requests.pid=###CURRENT_PID### AND tx_formtools_requests.sys_language_uid IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        1 => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'first_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.first_name',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.default.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'last_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.last_name',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.default.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'telephone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.phone',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.default.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'address' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.address',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.default.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.city',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.default.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.email',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.email.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'message' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.message',
            'description' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:databaseMapping.default.description',
            'config' => [
                'type' => 'text',
                'cols' => 50,
                'rows' => 5,
            ],
        ],
        'xml' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_tools/Resources/Private/Language/locallang_db.xlf:tx_formtools_requests.xml',
            'config' => [
                'type' => 'text',
                'cols' => 50,
                'rows' => 5,
                'readOnly' => 1,
            ],
        ],
    ],
];
