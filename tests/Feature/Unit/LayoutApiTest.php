<?php

use Webkul\ProgressBar\Infolists\Components\ProgressBar;

describe('size()', function () {
    it('defaults to md', function () {
        expect(ProgressBar::make('v')->getBarSize())->toBe('md');
    });

    it('accepts all four values', function () {
        expect(ProgressBar::make('v')->size('xs')->getBarSize())->toBe('xs');
        expect(ProgressBar::make('v')->size('sm')->getBarSize())->toBe('sm');
        expect(ProgressBar::make('v')->size('md')->getBarSize())->toBe('md');
        expect(ProgressBar::make('v')->size('lg')->getBarSize())->toBe('lg');
    });

    it('falls back to md for unknown values', function () {
        expect(ProgressBar::make('v')->size('xxl')->getBarSize())->toBe('md');
    });
});

describe('shape()', function () {
    it('defaults to rounded', function () {
        expect(ProgressBar::make('v')->getShape())->toBe('rounded');
    });

    it('accepts all three values', function () {
        expect(ProgressBar::make('v')->shape('rounded')->getShape())->toBe('rounded');
        expect(ProgressBar::make('v')->shape('pill')->getShape())->toBe('pill');
        expect(ProgressBar::make('v')->shape('square')->getShape())->toBe('square');
    });

    it('falls back to rounded for unknown values', function () {
        expect(ProgressBar::make('v')->shape('hex')->getShape())->toBe('rounded');
    });
});

describe('labelPosition()', function () {
    it('defaults to inside', function () {
        expect(ProgressBar::make('v')->getLabelPosition())->toBe('inside');
    });

    it('accepts inside / outside / none', function () {
        expect(ProgressBar::make('v')->labelPosition('inside')->getLabelPosition())->toBe('inside');
        expect(ProgressBar::make('v')->labelPosition('outside')->getLabelPosition())->toBe('outside');
        expect(ProgressBar::make('v')->labelPosition('none')->getLabelPosition())->toBe('none');
    });

    it('falls back to inside for unknown', function () {
        expect(ProgressBar::make('v')->labelPosition('under')->getLabelPosition())->toBe('inside');
    });
});

describe('showLabel()', function () {
    it('defaults to true (label shown)', function () {
        expect(ProgressBar::make('v')->shouldShowLabel())->toBeTrue();
    });

    it('showLabel(false) sets labelPosition to none', function () {
        $bar = ProgressBar::make('v')->showLabel(false);

        expect($bar->getLabelPosition())->toBe('none');
        expect($bar->shouldShowLabel())->toBeFalse();
    });

    it('showLabel() defaults to inside when re-enabled', function () {
        $bar = ProgressBar::make('v')->showLabel(false)->showLabel();

        expect($bar->getLabelPosition())->toBe('inside');
    });
});
