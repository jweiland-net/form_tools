.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

Finisher
========

StoreFieldsAsXmlToDb
--------------------

First of all you have to load our YAML file which contains a configuration to register
our finisher to EXT:form

.. code-block:: typoscript

   plugin.tx_form.settings.yamlConfigurations.100 = EXT:form_tools/Configuration/Form/StoreAsXml.yaml

Now you can use our finisher with the same configuration which is valid for SaveToDatabase finisher
of EXT:form

.. code-block:: yaml

   finishers:
     -
       options:
         table: 'tx_formtools_requests'
         mode: 'insert'
         elements:
           email-1:
             mapOnDatabaseColumn: 'email'
           textarea-1:
             mapOnDatabaseColumn: 'content'
         databaseColumnMappings:
           subject:
             value: 'Default Subject from YAML'
       identifier: StoreFieldsAsXmlToDb
