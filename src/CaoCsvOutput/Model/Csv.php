<?php

namespace CaoCsvOutput\Model;

class Csv
{
    protected $delimiter;

    protected $enclosure;

    protected $encloseAll;

    protected $data;

    public function __construct(array $data, $delimiter = ';', $enclosure = '"', $encloseAll = false)
    {
        $this->data = $data;
        $this->setDelimiter($delimiter);
        $this->setEnclosure($enclosure);
        $this->setEncloseAll($encloseAll);
    }

    /**
     * @param string $delimiter
     * @return Csv
     * @throws \InvalidArgumentException if delimiter is not a single character.
     */
    public function setDelimiter($delimiter)
    {
        if (!is_string($delimiter) || strlen($delimiter) != 1) {
            throw new \InvalidArgumentException('Delimiter must be a single character.');
        }
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * @param string $enclosure
     * @return Csv
     * @throws \InvalidArgumentException if enclosure is not a single character.
     */
    public function setEnclosure($enclosure)
    {
        if (!is_string($enclosure) || strlen($enclosure) != 1) {
            throw new \InvalidArgumentException('Enclosure must be a single character.');
        }
        $this->enclosure = $enclosure;

        return $this;
    }

    /**
     * Determines if every field should be enclosed by $enclosure.
     * If false (default) then field will only be enclosed if it contains a space, the
     * delimiter character, or the enclosure character.
     *
     * @param bool $encloseAll
     * @return Csv
     */
    public function setEncloseAll($encloseAll)
    {
        $this->encloseAll = (bool)$encloseAll;

        return $this;
    }

    public function render()
    {
        $delimiter_esc = preg_quote($this->delimiter, '/');
        $enclosure_esc = preg_quote($this->enclosure, '/');
        $encl = $this->enclosure;
        $str = '';

        foreach ($this->data as $row) {
            $output = array();
            foreach ($row as $field) {
                // Enclose fields containing $delimiter, $enclosure or whitespace
                if ($this->encloseAll || preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field)) {
                    $output[] = $encl . str_replace($encl, $encl . $encl, $field) . $encl;
                } else {
                    $output[] = $field;
                }
            }
            $str .= implode($this->delimiter, $output) . PHP_EOL;
        }

        return $str;
    }
}