<?php

namespace CaoCsvOutput\View\Helper;

use CaoCsvOutput\Model\Csv;
use Zend\View\Helper\AbstractHelper;

class CaoCsvOutput extends AbstractHelper
{
    public function __invoke(array $data, $delimiter = ';', $enclosure = '"', $encloseAll = false)
    {
        $csv = new Csv($data, $delimiter, $enclosure, $encloseAll);
        $escape = $this->getView()->plugin('escapehtml');

        return nl2br($escape($csv->render()));
    }
}