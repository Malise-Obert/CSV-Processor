<?php

namespace Classes;

class BiMonthlySales
{
    /**
     * @param $csvData
     *
     * @return array
     *
     */
    public function prepareSalesData($csvData)
    {
        $preparedSalesData = [];
        foreach ($csvData as $sale) {
            $month = explode('-', $sale['Date'])[1];
            $key = implode(',', [$sale['Client'], $sale['Product'], "'" .$month . "'"]);

            if (!isset($preparedSalesData[$key])) {
                $preparedSalesData[$key] = [
                    'total' => 0,
                    'count' => 0,
                ];
            }

            $preparedSalesData[$key]['total'] += $sale['Amount'];
            $preparedSalesData[$key]['count']++;
        }

        return $preparedSalesData;
    }

    /**
     * @param $preparedSalesData
     *
     * @return array
     *
     */
    public function getSalesAggregate($preparedSalesData)
    {
        $tuple = [];
        foreach ($preparedSalesData as $key => $element) {

            $key = explode(",", $key);
            array_push($key, $element['total'], $element['count']);
            //$key = array_push(explode(",", $key), $element['total'], $element['count']);

            $tuple[]=$key;

            //echo "<pre>";
            //print_r($key);
            //echo "<\pre>";
            //break;

            //$tuple[]=[$key . ', ' . $element['total'] . ', ' . $element['count']];
        }

        return $tuple;
    }
}