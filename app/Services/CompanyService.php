<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Session;

class CompanyService
{
    use UploadTrait;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompanyService constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Get company list
     *
     * @return Company[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCompanyList()
    {
        $companyList = $this->companyRepository->getCompanyList();

        return $companyList;
    }

    /**
     * Create company
     *
     * @param $request
     */
    public function createCompany($request)
    {
        $logoPath = '';

        if ($request->hasFile('logo')) {
            $logoPath = $this->getUploadedLogoPath($request);
        }

        Company::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'website' => $request['website'],
            'logo' => $logoPath
        ]);
    }

    /**
     * Delete company
     *
     * @param $id
     */
    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);

        unlink(public_path() . '' . $company->logo . '.');
        $company->delete();
    }

    /**
     * Update company
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateCompany($request, $id)
    {
        $inputData = $request->all();

        $company = Company::findOrFail($id);

        if ($request->hasFile('logo')) {

            unlink(public_path() . '' . $company->logo . '.');

            $logoPath = $this->getUploadedLogoPath($request);

            $inputData['logo'] = $logoPath;
        }

        return $this->companyRepository->update($id, $inputData);


    }

    /**
     * Get uploaded logo path
     *
     * @param $request
     * @return string
     */
    private function getUploadedLogoPath($request)
    {
        $logoPath = '';

        $logo = $request->file('logo');
        // Make a image name based on current timestamp and file extension
        $name = time().'.'.$logo->getClientOriginalExtension();
        // Defining folder path
        $folder = '/uploads/logo/';
        // Make a file path where image will be stored [ folder path + file name]
        $logoPath = $folder . $name;

        $this->uploadOne($logo, $folder, 'public', $name);

        return $logoPath;
    }
}
