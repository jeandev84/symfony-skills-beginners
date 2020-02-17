<?php
use Framework\Entity\Employee;

define('PROJECT', __DIR__);

$paths = [
  'Functions.php',
  'Common/SingletonTrait.php',
  'Entity/Employee.php'
];

foreach ($paths as $path)
{
    require PROJECT. DIRECTORY_SEPARATOR. $path;
}


$employeeCollection = [
   new Employee('Жан-Клод', 150000),
   new Employee('Иван', 70000),
   new Employee('Анатолий', 38000),
   new Employee('Брюс', 25000)
];


echo printEachEmployeeInfo($employeeCollection);
echo (php_sapi_name() != 'cli') ? "<br/>" : "\n";


