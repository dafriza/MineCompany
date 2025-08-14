<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class AuthService {
    private array $validatedData;

    private function setValidatedData(array $validatedData) : void {
        $this->validatedData = $validatedData;
    }

    private function getValidatedData() : array {
        return $this->validatedData;
    }

    public function authProcess(array $validatedData) : bool {
        $this->setValidatedData($validatedData);
        $isAuthenticated = $this->authenticate();
        return $isAuthenticated;
    }

    private function authenticate() : bool {
        $validatedData = $this->getValidatedData();
        $isAuthenticated = Auth::attempt($validatedData);

        return $isAuthenticated;
    }
}