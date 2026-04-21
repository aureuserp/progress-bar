<?php

namespace Webkul\ProgressBar;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ProgressBarServiceProvider extends PackageServiceProvider
{
    public static string $name = 'progress-bar';

    public static string $viewNamespace = 'progress-bar';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews(static::$viewNamespace);
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('progress-bar-styles', __DIR__.'/../resources/dist/progress-bar.css'),
        ], 'aureuserp/progress-bar');
    }
}
