<?php

require_once 'vendor/box/spout/src/Spout/Autoloader/autoload.php';
require 'vendor/autoload.php';

use Classes\CSVReader;
use Classes\CSVWriter;
use Classes\BiMonthlySales;

$filePath ='sales.csv';

$loadAndReadCsvFile = new CSVReader($filePath);

$salesData = new BiMonthlySales();

$preparedSalesData = $salesData->prepareSalesData($loadAndReadCsvFile->fileReader());

$writeCsv =  new CSVWriter($salesData->getSalesAggregate($preparedSalesData));

if ($writeCsv->writeCsv()) {
    echo "The Sales Report CSV was written successfully";
}  else {
 echo "An Error occured was attempting to write the Sales Report CSV.";
}
?>




















