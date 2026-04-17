<?php

namespace Webkul\ProgressBar\Concerns;

use Closure;
use Webkul\ProgressBar\Enums\IconPosition;
use Webkul\ProgressBar\Enums\LabelPosition;
use Webkul\ProgressBar\Enums\Shape;
use Webkul\ProgressBar\Enums\Size;

trait HasProgressBarStyle
{
    protected int | float | Closure $max = 100;

    protected int | float | Closure $min = 0;

    protected int | float | Closure | null $valueOverride = null;

    protected int | Closure $precision = 2;

    protected ?Closure $labelFormatter = null;

    protected Size | string | Closure $size = Size::Medium;

    protected Shape | string | Closure $shape = Shape::Rounded;

    protected LabelPosition | string | Closure $labelPosition = LabelPosition::Inside;

    protected bool | Closure $striped = false;

    protected bool | Closure $animated = false;

    protected bool | Closure $indeterminate = false;

    protected bool | Closure $gradient = false;

    protected string | Closure $trackColor = 'gray';

    protected array | Closure | null $thresholds = null;

    protected int | float | Closure | null $warnAbove = null;

    protected string | Closure $warnColor = 'danger';

    protected string | Closure | null $icon = null;

    protected IconPosition | string | Closure $iconPosition = IconPosition::Start;

    public function maxValue(int | float | Closure $max): static
    {
        $this->max = $max;

        return $this;
    }

    public function getMaxValue(): int | float
    {
        return (float) ($this->evaluate($this->max) ?? 100);
    }

    public function minValue(int | float | Closure $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function getMinValue(): int | float
    {
        return (float) ($this->evaluate($this->min) ?? 0);
    }

    public function value(int | float | Closure $value): static
    {
        $this->valueOverride = $value;

        return $this;
    }

    public function getCurrentValue(): int | float
    {
        if ($this->valueOverride !== null) {
            $resolved = $this->evaluate($this->valueOverride);
        } else {
            $resolved = method_exists($this, 'getState') ? $this->getState() : null;

            if ($resolved instanceof Closure) {
                $resolved = $this->evaluate($resolved);
            }
        }

        if (is_numeric($resolved)) {
            return (float) $resolved;
        }

        return 0.0;
    }

    public function precision(int | Closure $decimals): static
    {
        $this->precision = $decimals;

        return $this;
    }

    public function getPrecision(): int
    {
        return (int) ($this->evaluate($this->precision) ?? 2);
    }

    public function formatLabel(Closure $formatter): static
    {
        $this->labelFormatter = $formatter;

        return $this;
    }

    public function getFormattedLabel(): string
    {
        $value = $this->getCurrentValue();

        $percentage = $this->getPercentage();

        if ($this->labelFormatter !== null) {
            $resolved = $this->evaluate($this->labelFormatter, [
                'value' => $value,
                'percentage' => $percentage,
                'min' => $this->getMinValue(),
                'max' => $this->getMaxValue(),
            ]);

            if (is_string($resolved) || is_numeric($resolved)) {
                return (string) $resolved;
            }
        }

        $decimals = $percentage == 100 ? 0 : $this->getPrecision();

        return number_format($percentage, $decimals).'%';
    }

    public function getPercentage(): float
    {
        $max = $this->getMaxValue();

        $min = $this->getMinValue();

        $range = $max - $min;

        if ($range <= 0) {
            return 0.0;
        }

        $value = $this->getCurrentValue() - $min;

        return max(0.0, min(100.0, ($value / $range) * 100));
    }

    public function isFull(): bool
    {
        return $this->getPercentage() >= 100;
    }

    public function size(Size | string | Closure $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getBarSize(): string
    {
        $resolved = $this->evaluate($this->size);

        $value = $resolved instanceof Size ? $resolved->value : $resolved;

        return Size::tryFrom((string) $value)?->value ?? Size::default()->value;
    }

    public function shape(Shape | string | Closure $shape): static
    {
        $this->shape = $shape;

        return $this;
    }

    public function getShape(): string
    {
        $resolved = $this->evaluate($this->shape);

        $value = $resolved instanceof Shape ? $resolved->value : $resolved;

        return Shape::tryFrom((string) $value)?->value ?? Shape::default()->value;
    }

    public function labelPosition(LabelPosition | string | Closure $position): static
    {
        $this->labelPosition = $position;

        return $this;
    }

    public function getLabelPosition(): string
    {
        $resolved = $this->evaluate($this->labelPosition);

        $value = $resolved instanceof LabelPosition ? $resolved->value : $resolved;

        return LabelPosition::tryFrom((string) $value)?->value ?? LabelPosition::default()->value;
    }

    public function showLabel(bool | Closure $condition = true): static
    {
        $this->labelPosition = $condition === false
            ? LabelPosition::None
            : LabelPosition::Inside;

        return $this;
    }

    public function shouldShowLabel(): bool
    {
        return $this->getLabelPosition() !== LabelPosition::None->value;
    }

    public function striped(bool | Closure $condition = true): static
    {
        $this->striped = $condition;

        return $this;
    }

    public function isStriped(): bool
    {
        return (bool) $this->evaluate($this->striped);
    }

    public function animated(bool | Closure $condition = true): static
    {
        $this->animated = $condition;

        if ((bool) $this->evaluate($condition)) {
            $this->striped = true;
        }

        return $this;
    }

    public function isAnimated(): bool
    {
        return (bool) $this->evaluate($this->animated);
    }

    public function indeterminate(bool | Closure $condition = true): static
    {
        $this->indeterminate = $condition;

        return $this;
    }

    public function isIndeterminate(): bool
    {
        return (bool) $this->evaluate($this->indeterminate);
    }

    public function gradient(bool | Closure $condition = true): static
    {
        $this->gradient = $condition;

        return $this;
    }

    public function isGradient(): bool
    {
        return (bool) $this->evaluate($this->gradient);
    }

    public function trackColor(string | Closure $color): static
    {
        $this->trackColor = $color;

        return $this;
    }

    public function getTrackColor(): string
    {
        return (string) ($this->evaluate($this->trackColor) ?? 'gray');
    }

    public function thresholds(array | Closure $thresholds): static
    {
        $this->thresholds = $thresholds;

        return $this;
    }

    public function getThresholds(): array
    {
        $resolved = $this->evaluate($this->thresholds) ?? [];

        return is_array($resolved) ? $resolved : [];
    }

    public function warnAbove(int | float | Closure $threshold, string | Closure $color = 'danger'): static
    {
        $this->warnAbove = $threshold;

        $this->warnColor = $color;

        return $this;
    }

    public function getWarnAbove(): int | float | null
    {
        $resolved = $this->evaluate($this->warnAbove);

        return is_numeric($resolved) ? (float) $resolved : null;
    }

    public function getWarnColor(): string
    {
        return (string) ($this->evaluate($this->warnColor) ?? 'danger');
    }

    public function getResolvedColor(): string
    {
        $warnAbove = $this->getWarnAbove();

        if ($warnAbove !== null && $this->getPercentage() > $warnAbove) {
            return $this->getWarnColor();
        }

        $thresholds = $this->getThresholds();

        if ($thresholds !== []) {
            krsort($thresholds);

            $percentage = $this->getPercentage();

            foreach ($thresholds as $boundary => $color) {
                if ($percentage >= (float) $boundary) {
                    return (string) $color;
                }
            }
        }

        if (method_exists($this, 'getColor')) {
            try {
                $state = method_exists($this, 'getState') ? $this->getState() : null;
                $color = $this->getColor($state);

                if (is_string($color) && $color !== '') {
                    return $color;
                }
            } catch (\Throwable) {
                // Component not attached to a container yet (e.g. during testing).
                // Fall through to the default.
            }
        }

        return 'primary';
    }

    public function icon(string | Closure | null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getBarIcon(): ?string
    {
        $resolved = $this->evaluate($this->icon);

        return is_string($resolved) && $resolved !== '' ? $resolved : null;
    }

    public function iconPosition(IconPosition | string | Closure $position): static
    {
        $this->iconPosition = $position;

        return $this;
    }

    public function getIconPosition(): string
    {
        $resolved = $this->evaluate($this->iconPosition);

        $value = $resolved instanceof IconPosition ? $resolved->value : $resolved;

        return IconPosition::tryFrom((string) $value)?->value ?? IconPosition::default()->value;
    }
}
