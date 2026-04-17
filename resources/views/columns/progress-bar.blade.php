@php
    $percentage = $getPercentage();
    $size = $getBarSize();
    $shape = $getShape();
    $color = $getResolvedColor();
    $trackColor = $getTrackColor();
    $labelPosition = $getLabelPosition();
    $isStriped = $isStriped();
    $isAnimated = $isAnimated();
    $isIndeterminate = $isIndeterminate();
    $isGradient = $isGradient();
    $icon = $getBarIcon();
    $iconPosition = $getIconPosition();
    $labelText = $getFormattedLabel();
    $isFull = $isFull();
    $min = $getMinValue();
    $max = $getMaxValue();
    $value = $getCurrentValue();
@endphp

<div class="pb-wrapper">
    <div
        class="pb-track"
        data-pb-size="{{ $size }}"
        data-pb-shape="{{ $shape }}"
        data-pb-color="{{ $color }}"
        data-pb-track-color="{{ $trackColor }}"
        data-pb-indeterminate="{{ $isIndeterminate ? 'true' : 'false' }}"
        role="progressbar"
        aria-valuenow="{{ $isIndeterminate ? '' : $percentage }}"
        aria-valuemin="{{ $min }}"
        aria-valuemax="{{ $max }}"
        aria-label="{{ $labelText }}"
    >
        <div
            class="pb-fill"
            style="width: {{ $isIndeterminate ? '40' : $percentage }}%;"
            data-pb-striped="{{ $isStriped ? 'true' : 'false' }}"
            data-pb-animated="{{ $isAnimated ? 'true' : 'false' }}"
            data-pb-gradient="{{ $isGradient ? 'true' : 'false' }}"
            data-pb-full="{{ $isFull ? 'true' : 'false' }}"
        ></div>

        @if ($labelPosition === 'inside' && ! $isIndeterminate)
            <div class="pb-label" data-pb-full="{{ $isFull ? 'true' : 'false' }}">
                @if ($icon && $iconPosition === 'start')
                    <x-filament::icon :icon="$icon" class="pb-icon" />
                @endif
                <span>{{ $labelText }}</span>
                @if ($icon && $iconPosition === 'end')
                    <x-filament::icon :icon="$icon" class="pb-icon" />
                @endif
            </div>
        @endif
    </div>

    @if ($labelPosition === 'outside' && ! $isIndeterminate)
        <div class="pb-label-outside">
            @if ($icon && $iconPosition === 'start')
                <x-filament::icon :icon="$icon" class="pb-icon" />
            @endif
            <span>{{ $labelText }}</span>
            @if ($icon && $iconPosition === 'end')
                <x-filament::icon :icon="$icon" class="pb-icon" />
            @endif
        </div>
    @endif
</div>
