<?php

require_once "phing/Task.php";

class BuilderTask extends Task
{

    /**
     * The message passed in the buildfile.
     */
    public $path = null;
    public $version = null;
    public $name = null;
    public $package = null;
    public $subpackage = null;
    public $author = null;
    public $link = null;
    public $copyright = null;
    public $license = null;

    public function setPath($str)
    {
        $this->path = $str;
    }

    public function setVersion($str)
    {
        $this->version = $str;
    }

    public function setName($str)
    {
        $this->name = $str;
    }

    public function setPackage($str)
    {
        $this->package = $str;
    }

    public function setSubpackage($str)
    {
        $this->subpackage = $str;
    }

    public function setAuthor($str)
    {
        $this->author = $str;
    }

    public function setLink($str)
    {
        $this->link = $str;
    }

    public function setCopyright($str)
    {
        $this->copyright = $str;
    }

    public function setLicense($str)
    {
        $this->license = $str;
    }

    /**
     * The init method: Do init steps.
     */
    public function init()
    {
        // nothing to do here
    }

    /**
     * The main entry point method.
     */
    public function main()
    {
        $DirectoryIterator = new RecursiveDirectoryIterator($this->path);
        $IteratorIterator = new RecursiveIteratorIterator($DirectoryIterator, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($IteratorIterator as $file)
        {

            $path = $file->getRealPath();
            if ($file->isDir())
            {
                copy(__DIR__ . '/../format/index.html', $path . '/index.html');
            } elseif ($file->isFile())
            {
                $extension = $file->getExtension();
                if (strtolower($extension) == 'xml')
                {
                    $this->_xml($file);
                } else
                {
                    $this->_common($file);
                }
            }
        }
    }

    private function _xml($file)
    {
        $currentDate = date('M d, Y');
        $contents = file_get_contents($file->getRealPath());
        $contents = preg_replace('/<creationDate>(.*)<\/creationDate>/', '<creationDate>' . $currentDate . '</creationDate>', $contents);
        $contents = preg_replace('/<version>(.*)<\/version>/', '<version>' . $this->version . '</version>', $contents);
        $contents = preg_replace('/<copyright>(.*)<\/copyright>/', '<copyright>' . $this->copyright . '</copyright>', $contents);
        file_put_contents($file->getRealPath(), $contents);
    }

    public function _common($file)
    {
        $source = file_get_contents(__DIR__ . '/../format/copyright.php');
    
        $source = str_replace('{name}', $this->name, $source);
        $source = str_replace('{package}', $this->package, $source);
        $source = str_replace('{subpackage}', $this->subpackage, $source);
        $source = str_replace('{author}', $this->author, $source);
        $source = str_replace('{link}', $this->link, $source);
        $source = str_replace('{copyright}', $this->copyright, $source);
        $source = str_replace('{license}', $this->license, $source);
        $source = str_replace('{version}', $this->version, $source);
        $source = str_replace('{builddate}', date('c'), $source);


        $target = file_get_contents($file->getRealPath());
        $contents = str_replace('/* {$id} */', $source, $target);
        file_put_contents($file->getRealPath(), $contents);
    }

}
