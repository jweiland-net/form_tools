# TYPO3 Extension `form_tools`

Events2 is an extension for TYPO3 CMS. It shows you a list of event entries incl.
detail view.

## 1 Features

* It contains a form finisher to store all form fields as XML structure in DB

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
