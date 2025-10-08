<?php

/*
 * This file is part of the package jweiland/form-tools.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die;

use TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask;

call_user_func(function () {
    // Register tx_formtools_requests for table garbage collection task
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class]['options']['tables']['tx_formtools_requests'] = [
        'dateField' => 'tstamp',
        'expirePeriod' => 30,
    ];
});
