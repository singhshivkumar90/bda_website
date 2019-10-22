<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);
}
