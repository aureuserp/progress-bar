<?php

use Filament\Contracts\Plugin;
use Filament\Infolists\Components\Entry;
use Filament\Tables\Columns\Column;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webkul\ProgressBar\Concerns\HasProgressBarStyle;
use Webkul\ProgressBar\Infolists\Components\ProgressBar as InfolistProgressBar;
use Webkul\ProgressBar\ProgressBarPlugin;
use Webkul\ProgressBar\ProgressBarServiceProvider;
use Webkul\ProgressBar\Tables\Columns\ProgressBar as ColumnProgressBar;

it('column component extends Filament Column', function () {
    expect(is_subclass_of(ColumnProgressBar::class, Column::class))->toBeTrue();
});

it('infolist component extends Filament Entry', function () {
    expect(is_subclass_of(InfolistProgressBar::class, Entry::class))->toBeTrue();
});

it('both components use the shared style trait', function () {
    expect(class_uses_recursive(ColumnProgressBar::class))->toContain(HasProgressBarStyle::class);
    expect(class_uses_recursive(InfolistProgressBar::class))->toContain(HasProgressBarStyle::class);
});

it('plugin implements the Filament Plugin contract', function () {
    expect(in_array(Plugin::class, class_implements(ProgressBarPlugin::class), true))->toBeTrue();
});

it('service provider extends Spatie PackageServiceProvider', function () {
    expect(is_subclass_of(ProgressBarServiceProvider::class, PackageServiceProvider::class))->toBeTrue();
});

arch('no debug calls leak into shipped code')
    ->expect('Webkul\\ProgressBar')
    ->not->toUse(['dd', 'dump', 'var_dump', 'ray', 'die', 'exit']);
