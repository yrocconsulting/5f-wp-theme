/* Gallery filter buttons: show one category of photos (class fivef-cat-<name>). */
(function () {
	'use strict';
	var bar = document.querySelector('.fivef-gallery-filters');
	if (!bar) {
		return;
	}
	var page = bar.closest('.fivef-gallery-page') || document;
	var buttons = Array.prototype.slice.call(bar.querySelectorAll('.fivef-filter'));
	var aliases = { 'duck-hunts': 'ducks', 'hog-hunts': 'hogs', 'the-ranch': 'ranch' };

	function apply(filter, fromHash) {
		if (!buttons.some(function (b) { return b.getAttribute('data-filter') === filter; })) {
			filter = 'all';
		}
		buttons.forEach(function (b) {
			var on = b.getAttribute('data-filter') === filter;
			b.classList.toggle('is-active', on);
			b.setAttribute('aria-pressed', String(on));
		});
		page.querySelectorAll('.fivef-gallery-section').forEach(function (section) {
			var shown = 0;
			section.querySelectorAll('figure.wp-block-image').forEach(function (fig) {
				var match = filter === 'all' || fig.classList.contains('fivef-cat-' + filter);
				fig.hidden = !match;
				if (match) {
					shown++;
				}
			});
			section.hidden = shown === 0;
			// Section headings only make sense when everything is shown.
			var heading = section.querySelector('h2');
			if (heading) {
				heading.hidden = filter !== 'all';
			}
		});
		if (!fromHash) {
			var hash = filter === 'all' ? '' : '#' + filter;
			if (window.history && history.replaceState) {
				history.replaceState(null, '', window.location.pathname + window.location.search + hash);
			}
		}
	}

	buttons.forEach(function (b) {
		b.addEventListener('click', function () {
			apply(b.getAttribute('data-filter'));
		});
	});

	var start = window.location.hash.replace('#', '');
	if (start) {
		apply(aliases[start] || start, true);
		bar.scrollIntoView({ block: 'start' });
	}
})();
