<?php

namespace App\Models\Concerns;

use App\Str;
use App\Tree;
use Spatie\Url\Url;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait PresentsPostAttributes
{
    public function tree() : Attribute
    {
        return Attribute::make(
            fn () => (new Tree)->build($this->content)
        );
    }

    public function content() : Attribute
    {
        return Attribute::make(
            fn (string $value) => Blade::render(Str::markdown($value ?? ''))
        )->shouldCache();
    }

    public function teaser() : Attribute
    {
        return Attribute::make(
            fn (?string $value) => Str::markdown($value ?? '')
        )->shouldCache();
    }

    public function communityLinkDomain() : Attribute
    {
        return Attribute::make(
            fn (?string $value) => str_replace('www.', '', Url::fromString($value)->getHost())
        );
    }

    public function lastUpdate() : Attribute
    {
        return Attribute::make(
            fn () => ($this->updated_at ?? $this->created)->toDateTimeString()
        );
    }
}
