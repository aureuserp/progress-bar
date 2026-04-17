<?php

use Webkul\ProgressBar\Enums\IconPosition;
use Webkul\ProgressBar\Enums\LabelPosition;
use Webkul\ProgressBar\Enums\Shape;
use Webkul\ProgressBar\Enums\Size;
use Webkul\ProgressBar\Infolists\Components\ProgressBar;

it('accepts Size enum for size()', function () {
    expect(ProgressBar::make('v')->size(Size::Tiny)->getBarSize())->toBe('xs');
    expect(ProgressBar::make('v')->size(Size::Small)->getBarSize())->toBe('sm');
    expect(ProgressBar::make('v')->size(Size::Medium)->getBarSize())->toBe('md');
    expect(ProgressBar::make('v')->size(Size::Large)->getBarSize())->toBe('lg');
});

it('accepts Shape enum for shape()', function () {
    expect(ProgressBar::make('v')->shape(Shape::Rounded)->getShape())->toBe('rounded');
    expect(ProgressBar::make('v')->shape(Shape::Pill)->getShape())->toBe('pill');
    expect(ProgressBar::make('v')->shape(Shape::Square)->getShape())->toBe('square');
});

it('accepts LabelPosition enum for labelPosition()', function () {
    expect(ProgressBar::make('v')->labelPosition(LabelPosition::Inside)->getLabelPosition())->toBe('inside');
    expect(ProgressBar::make('v')->labelPosition(LabelPosition::Outside)->getLabelPosition())->toBe('outside');
    expect(ProgressBar::make('v')->labelPosition(LabelPosition::None)->getLabelPosition())->toBe('none');
});

it('accepts IconPosition enum for iconPosition()', function () {
    expect(ProgressBar::make('v')->iconPosition(IconPosition::Start)->getIconPosition())->toBe('start');
    expect(ProgressBar::make('v')->iconPosition(IconPosition::End)->getIconPosition())->toBe('end');
});

it('string input continues to work', function () {
    expect(ProgressBar::make('v')->size('lg')->getBarSize())->toBe('lg');
    expect(ProgressBar::make('v')->shape('pill')->getShape())->toBe('pill');
    expect(ProgressBar::make('v')->labelPosition('outside')->getLabelPosition())->toBe('outside');
    expect(ProgressBar::make('v')->iconPosition('end')->getIconPosition())->toBe('end');
});

it('accepts a closure that returns an enum', function () {
    expect(ProgressBar::make('v')->size(fn () => Size::Large)->getBarSize())->toBe('lg');
    expect(ProgressBar::make('v')->shape(fn () => Shape::Pill)->getShape())->toBe('pill');
});

it('each enum exposes a default() matching the trait default', function () {
    expect(Size::default())->toBe(Size::Medium);
    expect(Shape::default())->toBe(Shape::Rounded);
    expect(LabelPosition::default())->toBe(LabelPosition::Inside);
    expect(IconPosition::default())->toBe(IconPosition::Start);
});
