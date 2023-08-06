<?php

namespace App\Models\Traits;

use Filament\Panel;

trait IsFilamentUser
{
    public function canAccessPanel(Panel $panel) : bool
    {
        return true;
    }

    public function getFilamentAvatarUrl() : ?string
    {
        return $this->gravatar;
    }
}
