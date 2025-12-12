<?php

namespace Modules\Core\App\DTO;

readonly abstract class BaseDTO
{
     /**
     * Converts entire DTO to array for JSON/API responses.
     *
     * Automatically handles ALL public properties + dates. Add new fields anytime -
     * no code changes needed! Works like magic mirror seeing all your toys.
     *
     * @return array Complete data as array, ready for json_encode()
     *
     * @example
     *  $user = new UserDto(123);
     *  $user->name = 'Alex';
     *  $user->email = 'alex@example.com';
     *  print_r($user->toArray());
     *  // ['id' => 123, 'createdAt' => '2025-...', 'name' => 'Alex', 'email' => '...']
     */
    public function toArray(): array
    {
        return json_decode(json_encode($this), true) ?: [];
    }
}
