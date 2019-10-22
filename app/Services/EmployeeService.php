<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeService
{
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * EmployeeService constructor.
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Get employee list
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getEmployeeList()
    {
        $employeeList = $this->employeeRepository->getEmployeeList();

        return $employeeList;
    }

    /**
     * Create employee
     *
     * @param $request
     */
    public function createEmployee($request)
    {
        Employee::create($request->all());
    }

    /**
     * Update employee
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateEmployee($request, $id)
    {
        $inputData = $request->all();

        return $this->employeeRepository->update($id, $inputData);
    }
}
