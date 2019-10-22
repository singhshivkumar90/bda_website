<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Services\CompanyService;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * EmployeeController constructor.
     * @param EmployeeService $employeeService
     * @param CompanyService $companyService
     */
    public function __construct(EmployeeService $employeeService, CompanyService $companyService)
    {
        $this->employeeService = $employeeService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $employeeList = $this->employeeService->getEmployeeList();

        return view('employees.index',compact('employeeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $companyList = $this->companyService->getCompanyList();

        return view('employees.create', compact('companyList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateEmployeeRequest $request)
    {
        $this->employeeService->createEmployee($request);

        return redirect()->route('employees.index')
            ->with('success','Employee record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Employee $employee)
    {
        $companyList = $this->companyService->getCompanyList();
        $data = [];

        $data['companyList'] = $companyList;
        $data['employee'] = $employee;

        return view('employees.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $this->employeeService->updateEmployee($request, $id);

        return redirect()->route('employees.index')
            ->with('success','Employee record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();

        return redirect()->route('employees.index')
            ->with('success','Employee record deleted successfully.');
    }
}
