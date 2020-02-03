<?php


/**
 * @param $parsed
 * @param bool $die
*/
function debug($parsed, $die = false)
{
    echo '<pre>';
    print_r($parsed);
    echo '</pre>';
    if($die) die;
}


/**
 * @param $parsed
 * @param bool $die
*/
function dump($parsed, $die = false)
{
    echo '<pre>';
    var_dump($parsed);
    echo '</pre>';
    if($die) die;
}


/**
 * @param $employeeCollection
 * @return string
*/
function printEachEmployeeInfo($employeeCollection)
{
    $i = 0;
    $template = '';
    foreach ($employeeCollection as $employee)
    {
        debug($employee);
        /* debug($employee); echo $employee->getNameAndSalary(); */
        $template .= $employee->getNameAndSalary();
        $i++;
        if(count($employeeCollection) == $i)
        {
            /* echo '<hr/>'; */
            $template .= '<hr/>';
        }
    }

    return $template;
}