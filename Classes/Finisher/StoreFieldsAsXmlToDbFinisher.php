<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/form-tools.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\FormTools\Finisher;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Form\Domain\Finishers\Exception\FinisherException;
use TYPO3\CMS\Form\Domain\Finishers\SaveToDatabaseFinisher;
use TYPO3\CMS\Form\Domain\Model\FormElements\FormElementInterface;

/*
 * This finisher is based on the SaveToDatabase finisher of EXT:form
 * and extends it with the functionality to store all other
 * fields not available in DB as XML structure in column `xml`
 */
class StoreFieldsAsXmlToDbFinisher extends SaveToDatabaseFinisher
{
    /**
     * @var array
     */
    protected $defaultOptions = [
        'table' => 'tx_formtools_requests',
        'mode' => 'insert',
        'pageUid' => 0,
        'whereClause' => [],
        'elements' => [],
        'databaseColumnMappings' => [],
    ];

    /**
     * Executes this finisher
     *
     * @see AbstractFinisher::execute()
     * @throws FinisherException
     */
    protected function executeInternal()
    {
        $this->process(0);
    }

    /**
     * Prepare data for saving to database
     *
     * @param array $elementsConfiguration
     * @param array $databaseData
     * @return mixed
     */
    protected function prepareData(array $elementsConfiguration, array $databaseData)
    {
        $prepareData = parent::prepareData($elementsConfiguration, $databaseData);

        $dataForXml = ['elements' => []];
        $dataForXml['elements'] = $this->getFormValues();
        $this->addEmailFromFormValues($prepareData, $dataForXml['elements']);
        $this->addPidFromFormValues($prepareData);
        $prepareData['tstamp'] = $prepareData['tstamp'] ?: time();
        $prepareData['crdate'] = $prepareData['crdate'] ?: time();

        $prepareData['xml'] = GeneralUtility::array2xml($dataForXml);

        if (empty($prepareData['pid'])) {
            // if no default pid was configured through databaseColumnMappings, use pageUid from form wizard
            // if pid is still empty, fall back to current page
            $prepareData['pid'] = (int)$this->parseOption('pageUid') ?: (int)$GLOBALS['TSFE']->id ?: 0;
        }

        return $prepareData;
    }

    protected function addEmailFromFormValues(array &$prepareData, array $elements = []): void
    {
        if ($prepareData['email']) {
            return;
        }

        foreach ($elements as $elementIdentifier => $value) {
            $element = $this->getElementByIdentifier($elementIdentifier);
            if (
                $element instanceof FormElementInterface
                && !empty($value)
                && $element->getType() === 'Email'
                && GeneralUtility::validEmail($value)
            ) {
                $prepareData['email'] = $value;
            }
        }
    }

    protected function addPidFromFormValues(array &$prepareData): void
    {
        // Prio 3: Fall back to current page, if all other checks are false
        $pid = (int)$GLOBALS['TSFE']->id;

        // Prio 2: Override PID, if a default is configured by databaseColumnMappings
        if ($prepareData['pid']) {
            $pid = (int)$prepareData['pid'];
        }

        // Prio 1: Override PID, if an individual PID was configured in form wizard
        if ($this->parseOption('pageUid')) {
            $pid = (int)$this->parseOption('pageUid');
        }

        $prepareData['pid'] = $pid;
    }

    protected function getFormValues(): array
    {
        $elements = $this->finisherContext->getFormValues();
        foreach ($elements as $elementIdentifier => $value) {
            $element = $this->getElementByIdentifier($elementIdentifier);
            if (
                $value instanceof \DateTime
                && $element instanceof FormElementInterface
            ) {
                $properties = $element->getProperties();
                $elements[$elementIdentifier] = $value->format(
                    !empty($properties['dateFormat']) ? $properties['dateFormat'] : \DateTime::W3C,
                );
            }
        }
        return $elements;
    }
}
