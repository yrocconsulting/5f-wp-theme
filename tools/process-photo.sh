#!/usr/bin/env bash
# Resize and colour-grade a ranch photo into a theme photo slot.
#
#   tools/process-photo.sh <input-image> <slot>
#
# Slots: aerial-ponds long-pond quarry-lake geese-lake stock-tank creek
#        creek-bottom ranch-overview headquarters
#
# The grade warms the midday drone light toward the brand's golden-hour look:
# a touch more saturation and contrast, warmer highlights, softer blue cast.
# Requires ImageMagick.
set -euo pipefail

in="${1:?input image}"
slot="${2:?slot name}"
out="$(cd "$(dirname "$0")/.." && pwd)/5f-ranch/assets/photos/${slot}.jpg"

convert "$in" -auto-orient \
	-resize '2000x2000>' \
	-modulate 101,110,100 \
	-sigmoidal-contrast 2.5,45% \
	-channel R -evaluate multiply 1.025 \
	-channel G -evaluate multiply 1.01 \
	-channel B -evaluate multiply 0.965 +channel \
	-unsharp 0x0.8+0.6+0.02 \
	-strip -interlace Plane -sampling-factor 4:2:0 -quality 80 \
	"$out"

echo "Wrote $out ($(du -h "$out" | cut -f1))"
