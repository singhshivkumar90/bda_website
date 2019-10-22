<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository extends Repository
{
    /**
     * @var object
     */
    protected $model;

    /**
     * To initialize class object/variables
     *
     * @param Employee $model
     */
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    /**
     * Get employee list
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getEmployeeList()
    {
        $employeeList = Employee::with('company')->orderByDesc('updated_at')->paginate(10);

        return $employeeList;
    }

    /**
     * Update Employee
     *
     * @param $id
     * @param $inputData
     * @return mixed
     */
    public function update($id, $inputData)
    {
        $employee = $this->model->find($id);

        $isEmployeeUpdate = $employee->update($inputData);

        return $isEmployeeUpdate;
    }
}
