<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'website', 'logo'];

    /**
     * @return HasMany
     */
    public function employee()
    {
        return $this->hasMany(
            Employee::class
        );
    }
}
