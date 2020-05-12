<?php


namespace App\Processes;

/**
 * Class ReadFileProcess
 * @package App\Processes
 */
class ReadFileProcess {
    protected $path;

    /**
     * ProcessReadFile constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param $row
     * @return string[]
     */
    public function readFOFile($row)
    {
        return $this->readFOF($row);
    }

    /**
     * @param $row
     * @return string[]
     */
    public function readYieldFile($row)
    {
        return $this->iterateFields($this->readYeild($row), $row);
    }

    /**
     * @param $row
     * @return string[]
     */
    private function readFOF($row)
    {
        $handle = fopen($this->path, "r");

        $i=0;
        $row_data = [];
        while(!feof($handle)) {
            $row_data[] = fgets($handle);
            if($i == $row) {
                break;
            }
            $i++;
        }

        fclose($handle);
        return $row_data;
    }

    /**
     * @param $row
     * @return string
     */
    public function readSed($row)
    {
        $row++;
        $content = exec(sprintf('sed -n %dp %s', $row, $this->path));
        if (empty($content)) {
            return 'Unable to find data';
        }
        return $content;
    }

    /**
     * @param $row
     * @return \Generator
     */
    private function readYeild($row) {
        $handle = fopen($this->path, "r");

        $i=0;
        while(!feof($handle)) {
            yield fgets($handle);
            if($i == $row) {
                break;
            }
            $i++;
        }

        fclose($handle);
    }

    /**
     * @param $row
     * @return array|false|string
     */
    public function readSplObject($row)
    {
        $file = new \SplFileObject($this->path);
        $file->seek($row);
        return $file->current();
    }

    /**
     * @param $row
     * @return false|string[]
     */
    public function readSplObjectAsArray($row)
    {
        return $this->iterateFields(
            new \IteratorIterator(
                new \SplFileObject($this->path)
            ),
            $row
        );
    }

    /**
     * @param $fields
     * @param int $row
     * @return false|string[]
     */
    protected function iterateFields($fields, $row)
    {
        $values =  [];
        foreach ($fields as $key => $value) {
            $values[] = $value;
            if ($key == $row) {
                break;
            }
        }
        return $values;
    }
}
