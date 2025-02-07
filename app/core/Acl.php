<?php

namespace App\Core;

class Acl 
{
    protected array $roles = [];
    protected array $permissions = [];

    public function addRole(string $role): void 
    {
        $this->roles[$role] = [];
    }

    public function addPermission(string $role, string $permission): void 
    {
        if (!isset($this->roles[$role])) {
            $this->addRole($role);
        }
        $this->roles[$role][] = $permission;
    }

    public function hasPermission(string $role, string $permission): bool 
    {
        return isset($this->roles[$role]) && in_array($permission, $this->roles[$role]);
    }

    public function getRolePermissions(string $role): array 
    {
        return $this->roles[$role] ?? [];
    }
}
