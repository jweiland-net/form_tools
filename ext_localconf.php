<?php

call_user_func(function () {
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'Checkboxlink-icon',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:form_tools/Resources/Public/Icons/Form/Checkboxlink-icon.svg']
    );

    // Register tx_formtools_requests for table garbage collection task
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask::class]['options']['tables']['tx_formtools_requests'] = [
        'dateField' => 'tstamp',
        'expirePeriod' => 30
    ];
});
