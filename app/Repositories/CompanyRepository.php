<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository extends Repository
{
    /**
     * @var object
     */
    protected $model;

    /**
     * To initialize class object/variables
     *
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    /**
     * Get company list
     *
     * @return Company[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCompanyList()
    {
        $companyList = Company::all();

        return $companyList;
    }

    /**
     * Update Company
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
