<?php

class PhantomJs {

    /**
     * Path to phantomjs.
     *
     * @var string
     */
    protected $bin;

    /**
     * Function consruct.
     *
     * @param string $bin
     * @param boolean $debug
     */
    public function __construct($bin = "phantomjs")
    {
        $this->bin = $bin;
    }

    /**
     * Function execute script.
     * 
     * @param string $pathToScript
     * @param array $runOptions
     * @param array $options
     * 
     * @return array or string
     */
    public function execute($pathToScript, $runOptions = array(), $options = array())
    {
        $cmd = $this->bin
           . " " . $this->runOptionsAsString($runOptions)
           . " " . $pathToScript
           . " " . $this->optionsAsString($options);
        
        $response = shell_exec(escapeshellcmd($cmd));

        if($this->isJsonFormat($response)) {
            $response = json_decode($response, true);
        }

        return $response;
    }

    /**
     * Convert array of run options to options string.
     * 
     * @param array $runOptions
     * 
     * @return string
     */
    protected function runOptionsAsString($runOptions = array())
    {
        $runOptionsStr = "";

        if(is_array($runOptions)) {
            $options = array();

            foreach($runOptions as $name => $value)
                $options[] = "--{$name}={$value}";

            if(!empty($options)) {
                $runOptionsStr = implode(" ", $options);
            }
        }

        return $runOptionsStr;
    }

    /**
     * Convert array of options to options string
     *
     * @param array $options
     * @return string
     */
    protected function optionsAsString($options = array())
    {
        $optionsStr = "";

        if((is_array($options)) && (!empty($options))) {
            $optionsStr = implode(" ", $options);
        }

        return $optionsStr;
    }

    protected function isJsonFormat($data)
    {
        $json = json_decode($data);

        return is_null($json) ? false: true;
    }
}