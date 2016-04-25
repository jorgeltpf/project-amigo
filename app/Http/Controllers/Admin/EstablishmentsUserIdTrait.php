<?php

namespace App\Http\Controllers\Admin;

use App\Models\Establishment;

trait EstablishmentsUserIdTrait {

    /**
     * Retorno o id dos estabelecimentos vinculados
     * com o usuário logado
     *
     * @param mixed $id 
     * @return array
     */

    public function findEstablishmentIds($id) {
        $establishmentIds = Establishment::whereHas('people', function ($q) use ($id) {
            $q->where('user_id', '=', $id);
        })->select(['establishments.id'])->get();
        return $establishmentIds;
    }
}