<?php

namespace WebDriverJs;

class CasperJs extends PhantomJs {

    /**
     * Convert array of options to options string
     *
     * @param array $options
     * 
     * @return string
     */
    protected function optionsAsString($options = array())
    {
        return parent::runOptionsAsString($options);
    }
}

