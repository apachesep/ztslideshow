<?php

require_once "phing/Task.php";

class HashTask extends Task
{

    /**
     * The message passed in the buildfile.
     */
    private $version = null;
    private $path = null;
    private $contract = null;
    private $data = null;
    private $hashpath = null;

    public function setVersion($str)
    {
        $this->version = $str;
    }

    public function setContract($str)
    {
        $this->contract = $str;
    }

    public function setPath($str)
    {
        $this->path = $str;
    }

    /**
     * The init method: Do init steps.
     */
    public function init()
    {
        // nothing to do here
        $this->data = array();
    }

    /**
     * The main entry point method.
     */
    public function main()
    {
        $this->hashpath = $this->path . '/hash.ini';
        $this->_writeCheckSumData($this->path);
    }

    private function _writeCheckSumData($path)
    {
        $contents = scandir($path);

        $checksums = '';
        $hashlist = array();

        foreach ($contents as $file)
        {
            if ($file != '.' && $file != '..' && $file != '.svn')
            {
                $dir = $path . '/' . $file;
                if (is_dir($dir))
                {
                    $this->_writeCheckSumData($dir);
                } elseif (!is_dir($dir))
                {
                    $data2 = file_get_contents($dir);
                    $hashlist[] = str_replace('./tmp/' . $this->version . '/', '', $dir) . '=' . md5_file($dir);
                }
            }
        }
        var_dump($hashlist);
        $hashlist = implode(PHP_EOL, $hashlist);
        $handle = fopen($this->hashpath, "a+");
        fwrite($handle, $hashlist);
        fclose($handle);
    }

}
