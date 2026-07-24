# 🚀 CHANGELOG — v1.0.0

### 🧩 Features

* Initial release of the **Progress Bar** plugin for Filament v5.
* Table column (`Tables\Columns\ProgressBar`) that renders a numeric value as a horizontal progress bar in any Filament table.
* Infolist entry (`Infolists\Components\ProgressBar`) for read-only progress visualisation on detail pages.
* `HasProgressBarStyle` concern sharing the styling API across the table column and infolist entry.
* Four sizes (Tiny, Small, Medium, Large) and three shapes (Rounded, Pill, Square) via the `Size` and `Shape` enums.
* Six built-in colors (primary, success, warning, danger, info, gray) plus custom panel colors.
* Threshold-driven colors (`->thresholds([...])`) and `->warnAbove()` to auto-flag over-budget values.
* Striped and animated (scrolling) pattern overlays, indeterminate looping animation, and gradient fill.
* Flexible labels — inside, outside, or hidden — with a custom formatter, plus start/end icons via the `LabelPosition` and `IconPosition` enums.
* ARIA-compliant output, always emitting `role="progressbar"` with `aria-valuenow/min/max` and `aria-label`.
* Custom min–max ranges beyond the default 0–100% scale.
* `ProgressBarPlugin` for registering the plugin with a Filament panel.
* Publishable configuration file (`config/progress-bar.php`).
* Self-contained, publishable CSS assets registered via `ProgressBarServiceProvider`.
* Translations for the shipped strings (`en` and `ar`).
