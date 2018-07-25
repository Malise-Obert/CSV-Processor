<?php

namespace Classes;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class CSVReader
{
    /**
     * @var $sales
     */
    public $sales;

    /**
     * @param $salesFile
     */
    public function __construct($salesFile) {
        $this->sales = $salesFile;
    }

    public function fileReader()
    {
        $reader = ReaderFactory::create(Type::CSV);
        $reader->open($this->sales);

        $sales = [];

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $sales[] = $row;
            }
        }

        $reader->close();

        $header = array_shift($sales);
        $newSalesList    = array();
        foreach($sales as $sale) {
            $newSalesList[] = array_combine($header, $sale);
        }

        return $newSalesList;
    }
}
