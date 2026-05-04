<?php

namespace App\Services;

use App\Models\People;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PeopleCredentialService
{
    /**
     * Set initial credentials for a person upon approval.
     */
    public function setCredentials(People $people, string $loginId, string $password, User $admin): void
    {
        $people->login_id = $loginId;
        $people->password = Hash::make($password);
        $people->plain_password_hint = Crypt::encryptString($password);
        $people->credentials_set_at = now();
        $people->credentials_set_by = $admin->name . ' (#' . $admin->id . ')';
        $people->login_status = 'active';
        $people->save();
    }

    /**
     * Decrypt the password hint for admin viewing.
     */
    public function decryptHint(People $people): string
    {
        try {
            return Crypt::decryptString($people->plain_password_hint);
        } catch (\Exception $e) {
            return '—';
        }
    }

    /**
     * Suspend portal access for a person.
     */
    public function suspendLogin(People $people): void
    {
        $people->login_status = 'suspended';
        $people->save();
    }

    /**
     * Activate portal access for a person.
     */
    public function activateLogin(People $people): void
    {
        $people->login_status = 'active';
        $people->save();
    }

    /**
     * Reset credentials for a person.
     */
    public function resetCredentials(People $people, string $newPassword, User $admin): void
    {
        $people->password = Hash::make($newPassword);
        $people->plain_password_hint = Crypt::encryptString($newPassword);
        $people->credentials_set_at = now();
        $people->credentials_set_by = $admin->name . ' (#' . $admin->id . ')';
        $people->save();
    }
}
