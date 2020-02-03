<?php
namespace Framework\Entity;



/**
 * Class Employee
 * @package Framework\Entity
 */
class Employee
{

    const PRIME = 65000;

    /** @var string */
    private $name;

    /** @var integer */
    private $salary;



    /**
     * Employee constructor.
     * @param string $name
     * @param int $salary
     */
    public function __construct(string $name = '', int $salary = 0)
    {
        $this->name = $name;
        $this->salary = $salary;
    }


    /**
     * @param string $name
     * @return Employee
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param int $salary
     * @return Employee
     */
    public function setSalary(int  $salary)
    {
        $this->salary = $salary;
        return $this;
    }

    /**
     * @return int
    */
    public function getSalary()
    {
        return $this->salary;
    }


    /**
     * @return string
     */
    public function getNameAndSalary()
    {
        return '<div>Hello ! '. $this->name .' ! Your salary is '. $this->salary . '</div>';
    }


    /**
     * @return int
    */
    public function getSalaryAndPrime()
    {
        return ($this->salary + self::PRIME);
    }

}



/*

dump(Employee::instance());
dump(Employee::instance());
dump(Employee::instance());
dump(Employee::instance());
dump(Employee::instance());

----------------------------------------

$employeeX = new Employee();
dump($employeeX);
dump($employeeX);
dump($employeeX);
dump($employeeX);
----------------------------------------

$employee = new Employee();
$employee->setName('Жан-Клод')
         ->setSalary(35000);

echo $employee->getNameAndSalary();
*/