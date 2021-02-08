<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/form_tools.
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
     * @see AbstractFinisher::execute()
     *
     * @throws FinisherException
     */
    protected function executeInternal()
    {
        $options = [];
        if (isset($this->options['pageUid'])) {
            $options[] = $this->options;
        } else {
            $options = $this->options;
        }

        foreach ($options as $optionKey => $option) {
            $this->options = $option;
            $this->process($optionKey);
        }
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

        $prepareData['xml'] = GeneralUtility::array2xml($dataForXml);

        // Get PID from FormWizard, TCEForms or fallback to default 0
        $prepareData['pid'] = (int)$this->parseOption('pageUid');
        if (empty($prepareData['pid'])) {
            $prepareData['pid'] = (int)$GLOBALS['TSFE']->id;
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
                && $element->getType() === 'Email'
                && !empty($value)
                && GeneralUtility::validEmail($value)
            ) {
                $prepareData['email'] = $value;
            }
        }
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
                    !empty($properties['dateFormat']) ? $properties['dateFormat'] : \DateTime::W3C
                );
            }
        }
        return $elements;
    }
}
