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
use TYPO3\CMS\Form\Domain\Finishers\SaveToDatabaseFinisher;

/*
 * This finisher is based on the SaveToDatabase finisher of EXT:form
 * and extends it with the functionality to store all other
 * fields not available in DB as XML structure in column `xml`
 */
class StoreFieldsAsXmlToDbFinisher extends SaveToDatabaseFinisher
{
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

        $dataForXml = [
            'elements' => []
        ];
        $dataForXml['elements'] = $this->getFormValues();
        $prepareData['xml'] = GeneralUtility::array2xml($dataForXml);

        return $prepareData;
    }
}
