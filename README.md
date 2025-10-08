# TYPO3 Extension `form_tools`

[![Packagist][packagist-logo-stable]][extension-packagist-url]
[![Latest Stable Version][extension-build-shield]][extension-ter-url]
[![Total Downloads][extension-downloads-badge]][extension-packagist-url]
[![Monthly Downloads][extension-monthly-downloads]][extension-packagist-url]
[![TYPO3 13.4][TYPO3-shield]][TYPO3-13-url]

![Build Status](https://github.com/jweiland-net/form_tools/actions/workflows/ci.yml/badge.svg)

Form_tools is an extension for TYPO3 CMS. It collects some tools for the TYPO3 FormFramework.

## 1 Features

* It contains a form finisher to store all form fields as XML structure in DB
* It contains a form element to set up a GDPR link in your form (works with the form editor)

## 2 Usage

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is using Composer.

Run the following command within your Composer based TYPO3 project:

```
composer require jweiland/form-tools
```

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install `form_tools` with the extension manager module.

### 2.2 Minimal setup

1) Check if DB table `tx_formtools_requests` was created successfully
2) Open your TypoScript file or record
3) Add: `plugin.tx_form.settings.yamlConfigurations.1234 = EXT:form_tools/Configuration/Form/StoreAsXml.yaml`
4) Now you can use our finisher with identifier: `StoreFieldsAsXmlToDb`
5) Add: `plugin.tx_form.settings.yamlConfigurations.2345 = EXT:form_tools/Configuration/Form/Checkboxlink.yaml`
6) Add: `module.tx_form.settings.yamlConfigurations.2345 = EXT:form_tools/Configuration/Form/Checkboxlink.yaml`
7) Add:
   ```
    lib.formLegalUid = TEXT
    lib.formLegalUid.value = 1 # or e.g.: {$form.legalUid}
   ```
   to your SETUP and define a target for the "Data protection notice" link.
7) Now you can use the form element with type: `Checkboxlink`

### 2.3 Finisher StoreFieldsAsXmlToDb

Copy the finisher to your form YAML file.

```

  -
    options:
      -
        table: tx_formtools_requests
        mode: insert
        elements:
          text-1:
            mapOnDatabaseColumn: first_name
          name:
            mapOnDatabaseColumn: last_name
          telefon:
            mapOnDatabaseColumn: telephone
          strasse:
            mapOnDatabaseColumn: address
          plzort:
            mapOnDatabaseColumn: city
          email:
            mapOnDatabaseColumn: email
          textarea-2:
            mapOnDatabaseColumn: message
        databaseColumnMappings:
          pid:
            value: 12107
          tstamp:
            value: '{__currentTimestamp}'
          crdate:
            value: '{__currentTimestamp}'
    identifier: StoreFieldsAsXmlToDb
```

* Some fields like `first_name` till `message` already exist in the Datatbase. You can map your renderables to them.
* Set the pid where your mails should be saved (e.g. the same where your plugin resides).
* The database field `xml` will automaticaly contain all posted data.

## 3 Support

Free Support is available via [GitHub Issue Tracker](https://github.com/jweiland-net/form_tools/issues).

For commercial support, please contact us at [support@jweiland.net](support@jweiland.net).


<!-- MARKDOWN LINKS & IMAGES -->

[extension-build-shield]: https://poser.pugx.org/jweiland/form-tools/v/stable.svg?style=for-the-badge

[extension-downloads-badge]: https://poser.pugx.org/jweiland/form-tools/d/total.svg?style=for-the-badge

[extension-monthly-downloads]: https://poser.pugx.org/jweiland/form-tools/d/monthly?style=for-the-badge

[extension-ter-url]: https://extensions.typo3.org/extension/daycarecenters/

[extension-packagist-url]: https://packagist.org/packages/jweiland/form-tools/

[packagist-logo-stable]: https://img.shields.io/badge/--grey.svg?style=for-the-badge&logo=packagist&logoColor=white

[TYPO3-13-url]: https://get.typo3.org/version/13

[TYPO3-shield]: https://img.shields.io/badge/TYPO3-13.4-green.svg?style=for-the-badge&logo=typo3
