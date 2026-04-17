<?php

use Filament\Tables\Columns\Column;
use Webkul\ProgressBar\Tables\Columns\ProgressBar;

it('can be instantiated via make()', function () {
    expect(ProgressBar::make('progress'))->toBeInstanceOf(ProgressBar::class);
});

it('extends Filament Column', function () {
    expect(ProgressBar::make('progress'))->toBeInstanceOf(Column::class);
});

it('uses the expected column view path', function () {
    $column = ProgressBar::make('progress');

    $reflection = new ReflectionProperty($column, 'view');
    $reflection->setAccessible(true);

    expect($reflection->getValue($column))->toBe('progress-bar::columns.progress-bar');
});

it('chains all plugin-specific setters and returns static', function () {
    $column = ProgressBar::make('progress');

    expect($column->maxValue(200))->toBe($column);
    expect($column->minValue(10))->toBe($column);
    expect($column->value(50))->toBe($column);
    expect($column->precision(1))->toBe($column);
    expect($column->size('lg'))->toBe($column);
    expect($column->shape('pill'))->toBe($column);
    expect($column->labelPosition('outside'))->toBe($column);
    expect($column->showLabel(false))->toBe($column);
    expect($column->striped())->toBe($column);
    expect($column->animated())->toBe($column);
    expect($column->indeterminate())->toBe($column);
    expect($column->gradient())->toBe($column);
    expect($column->thresholds([0 => 'primary']))->toBe($column);
    expect($column->warnAbove(90))->toBe($column);
    expect($column->trackColor('info'))->toBe($column);
    expect($column->icon('heroicon-m-star'))->toBe($column);
    expect($column->iconPosition('end'))->toBe($column);
    expect($column->formatLabel(fn () => 'custom'))->toBe($column);
});
