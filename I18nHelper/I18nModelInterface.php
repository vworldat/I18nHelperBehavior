<?php

namespace C33s\Behavior\I18nHelper;

interface I18nModelInterface
{
    /**
     * Set an array of default locales to use for the c33s_i18n_helper behavior (getI18n*(), get*WithFallback()).
     *
     * @param array $locales
     *
     * @return self
     */
    public function setI18nDefaultLocales(array $locales);

    /**
     * Get an array of default locales used by the c33s_i18n_helper behavior (getI18n*(), get*WithFallback()).
     *
     * @return array
     */
    public function getI18nDefaultLocales();
}
