# I18nHelperBehavior
Helpful additions to default i18n propel behavior

Installation
------------

Require [`c33s/i18n-helper-behavior`](https://packagist.org/packages/c33s/i18n-helper-behavior)
in your `composer.json` file:


```js
{
    "require": {
        "c33s/i18n-helper-behavior": "@stable",
    }
}
```

Add propel behaviors to your propel config:

```yml
# When using symfony:
# app/config/config.yml

propel:
    # ...
    
    behaviors:
        c33s_i18n_helper:   vendor.c33s.i18n-helper-behavior.src.C33sPropelBehaviorI18nHelper

```

Usage
-----

Add behavior to your propel models - either globally (automatically for all models containing i18n behavior) or to a specific model:

```xml
<!-- my/Bundle/Resources/config/schema.xml -->

    <!-- globally for all i18n models -->
    <behavior name="c33s_i18n_helper">
        <parameter name="default_locales" value="de, en" />
    </behavior>

    <table name="book">
        <!-- model-specific -->
        <behavior name="i18n">
            <!-- configure i18n as needed -->
            <parameter name="i18n_columns" value="title" />
            <parameter name="default_locale" value="de" />
        </behavior>
        <behavior name="c33s_i18n_helper">
            <parameter name="default_locales" value="de, en" />
        </behavior>
        
        <column name="title" type="varchar" size="255" />
        
        <...>
    </table>

```

The behavior will add some convenience functions to your model. In the above example, the following methods will be generated for the i18n column `title`:

```php
<?php

use C33s\Behavior\I18nHelper\I18nModelInterface;

class BaseBook extends BaseObject implements Persistent, I18nModelInterface
{
    // ...
    
    // c33s_i18n_helper behavior

    /**
     * Get all available translations of the "Title" column.
     * This returns an associative array with locale => value pairs.
     *
     * @return array
     */
    public function getI18nTitle()
    {
        // ...
    }

    /**
     * Set translations of the "Title" column.
     * Accepts an associative array with locale => value pairs.
     *
     * @return Book
     */
    public function setI18nTitle($allTitles)
    {
        // ...
    }

    /**
     * Get i18n value of the "Title" column, using locale fallback (reverse default locales)
     * if the value is empty.
     * Starts with either the given locale or the current/default locale, set previously using getTranslation().
     *
     * @param string $locale
     *
     * @return mixed
     */
    public function getTitleWithFallback($locale = null)
    {
        // ...
    }
    
    /**
     * Set an array of default locales to use for the c33s_i18n_helper behavior (getI18n*(), get*WithFallback()).
     *
     * @param array $locales
     *
     * @return Book
     */
    public function setI18nDefaultLocales(array $locales)
    {
        // ...
    }

    /**
     * Get an array of default locales used by the c33s_i18n_helper behavior (getI18n*(), get*WithFallback()).
     *
     * @return array
     */
    public function getI18nDefaultLocales()
    {
        // ...
    }
}


```

In addition, all your i18n models will implement I18nModelInterface which is very helpful to recognize translatable objects whereever you have to. 

The getI18n*() methods can be used with Symfony2 `collection` FormTypes (e.g. collection of `text` inputs), allowing you to edit all translations of a given field at once without any further code or configuration. 

*TODO: forms example.*
*TODO: implement FormType guesser.*
