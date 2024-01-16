<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'data' => [
                'id_user' => $this->id_user,
                'name' => $this->name,
                'username' => $this->username,
                'gender' => $this->gender,
                'place_of_birth' => $this->place_of_birth != null ? $this->place_of_birth : '',
                'date_of_birth' => $this->date_of_birth != null ? $this->date_of_birth : '',
                'phone' => $this->no_telp != null ? $this->phone : '',
                'address' => $this->address != null ? $this->address : '',
                'email' => $this->email,
                // 'role_id' => $this->user_role->name,
                'role_id' => $this->role_id,
                'is_active' => $this->is_active == 'Y' ? 'Active' : 'Inactive',
                'token' => $this->whenNotNull($this->token),
            ]
        ];
    }
}
