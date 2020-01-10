<?php

namespace App\Util;

class CsvReader implements ReaderInterface
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * CsvReader constructor.
     * @param string $filename
     * @param string $delimiter
     */
    public function __construct(string $filename, string $delimiter = ';')
    {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }

    /**
     * @return array
     */
    public function read(): array
    {
        $header = NULL;
        $data = array();
        if (($handle = fopen($this->filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 0, $this->delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}