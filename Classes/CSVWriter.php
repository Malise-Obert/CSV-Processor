<?php

namespace Classes;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class CSVWriter
{
    /**
     * @var $csvData
     */
    public $csvData;

    /**
     * CSVWriter constructor.
     *
     * @param $csvData
     */
    public function __construct($csvData) {
        $this->csvData = $csvData;
    }

    public function writeCsv()
    {
        // TODO These Headers would be determined per required report...
        $exportHeaders = ["Client 1", "Product 1", "Mar", "Total", "Sale Count"];

        $writer = WriterFactory::create(Type::CSV);
        $writer->openToFile('output.csv');
        $writer->addRow($exportHeaders);

        foreach ($this->csvData as $key => $salesRow) {
            $writer->addRow($salesRow);
        }

        $writer->close();

        return true;
    }
}