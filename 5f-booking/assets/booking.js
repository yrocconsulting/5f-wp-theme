/* 5F Ranch booking calendar. No dependencies. */
(function () {
	'use strict';

	var root = document.querySelector('.fivef-bk');
	if (!root) {
		return;
	}
	var cfg = JSON.parse(root.getAttribute('data-config') || '{}');
	var typeKeys = Object.keys(cfg.types || {});
	var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

	var state = { type: cfg.start || typeKeys[0], data: {}, month: null, date: null, people: 0 };

	function el(tag, attrs, children) {
		var n = document.createElement(tag);
		Object.keys(attrs || {}).forEach(function (k) {
			if (k === 'text') {
				n.textContent = attrs[k];
			} else if (k === 'html') {
				n.innerHTML = attrs[k];
			} else if (k.indexOf('on') === 0) {
				n.addEventListener(k.slice(2), attrs[k]);
			} else if (attrs[k] !== false && attrs[k] !== null && attrs[k] !== undefined) {
				n.setAttribute(k, attrs[k] === true ? '' : attrs[k]);
			}
		});
		(children || []).forEach(function (c) {
			if (c) {
				n.appendChild(typeof c === 'string' ? document.createTextNode(c) : c);
			}
		});
		return n;
	}

	function money(n) {
		return '$' + Number(n).toLocaleString('en-US');
	}

	function quote(t, people, base, addon) {
		base = base || t.price;
		var discount = t.mode === 'spots' && people >= t.capacity && t.groupPrice < base;
		var per = discount ? t.groupPrice : base;
		var total = per * people;
		var deposit = t.depositPct ? Math.round(total * t.depositPct / 100) : t.deposit * people;
		addon = !!(addon && t.addon && people >= t.capacity);
		if (addon) {
			total += t.addon.price;
			deposit += t.addon.deposit;
		}
		deposit = Math.min(total, deposit);
		return { per: per, total: total, deposit: deposit, balance: total - deposit, discount: discount, addon: addon };
	}

	function ymd(y, m, d) {
		return y + '-' + String(m + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
	}

	function datesFor(type) {
		return (state.data[type] && state.data[type].dates) || [];
	}

	function findDate(type, date) {
		return datesFor(type).filter(function (d) {
			return d.date === date;
		})[0];
	}

	function render() {
		root.innerHTML = '';
		if (!typeKeys.length) {
			root.appendChild(el('p', { text: 'Online booking isn’t open right now. Please call ' + cfg.phone + '.' }));
			return;
		}
		var t = cfg.types[state.type];
		if (state.success) {
			root.appendChild(el('p', { class: 'fivef-bk-notice is-success', role: 'status', text: state.success }));
		}

		if (typeKeys.length > 1) {
			root.appendChild(el('div', { class: 'fivef-bk-tabs', role: 'tablist' }, typeKeys.map(function (k) {
				return el('button', {
					type: 'button', role: 'tab', class: 'fivef-bk-tab', 'aria-selected': String(k === state.type),
					text: cfg.types[k].label,
					onclick: function () {
						state.success = null;
						state.type = k;
						state.date = null;
						state.month = null;
						render();
					}
				});
			})));
		}
		root.appendChild(el('p', { class: 'fivef-bk-summary', text: t.summary }));

		var grid = el('div', { class: 'fivef-bk-grid' });
		grid.appendChild(renderCalendar(t));
		grid.appendChild(renderPanel(t));
		root.appendChild(grid);
	}

	function renderCalendar(t) {
		var dates = datesFor(state.type);
		var wrap = el('div', { class: 'fivef-bk-cal' });
		if (!dates.length) {
			wrap.appendChild(el('p', { class: 'fivef-bk-empty', text: 'No ' + t.label.toLowerCase() + ' dates are open yet. Call ' + cfg.phone + ' and we’ll let you know when the next ones open.' }));
			return wrap;
		}
		if (!state.month) {
			var first = dates.filter(function (d) { return d.left > 0; })[0] || dates[0];
			var p = first.date.split('-');
			state.month = { y: +p[0], m: +p[1] - 1 };
		}
		var y = state.month.y, m = state.month.m;
		var firstDate = dates[0].date, lastDate = dates[dates.length - 1].date;
		var monthStart = ymd(y, m, 1), monthEnd = ymd(y, m, new Date(y, m + 1, 0).getDate());

		function shift(n) {
			var d = new Date(y, m + n, 1);
			state.month = { y: d.getFullYear(), m: d.getMonth() };
			render();
		}
		wrap.appendChild(el('div', { class: 'fivef-bk-cal-head' }, [
			el('button', { type: 'button', class: 'fivef-bk-nav', 'aria-label': 'Previous month', disabled: monthStart <= firstDate, onclick: function () { shift(-1); }, text: '‹' }),
			el('h3', { class: 'fivef-bk-month', 'aria-live': 'polite', text: MONTHS[m] + ' ' + y }),
			el('button', { type: 'button', class: 'fivef-bk-nav', 'aria-label': 'Next month', disabled: monthEnd >= lastDate, onclick: function () { shift(1); }, text: '›' })
		]));

		var table = el('div', { class: 'fivef-bk-days', role: 'grid' });
		DAYS.forEach(function (d) {
			table.appendChild(el('div', { class: 'fivef-bk-dow', text: d }));
		});
		var lead = new Date(y, m, 1).getDay();
		for (var i = 0; i < lead; i++) {
			table.appendChild(el('div', { class: 'fivef-bk-day is-blank' }));
		}
		var days = new Date(y, m + 1, 0).getDate();
		for (var d = 1; d <= days; d++) {
			var key = ymd(y, m, d);
			var info = findDate(state.type, key);
			if (!info) {
				table.appendChild(el('div', { class: 'fivef-bk-day', text: String(d) }));
				continue;
			}
			var full = info.left < 1;
			var note = full ? 'Booked' : (t.mode === 'group' ? 'Open' : info.left + (info.left === 1 ? ' spot' : ' spots'));
			table.appendChild(el('button', {
				type: 'button',
				class: 'fivef-bk-day is-open' + (full ? ' is-full' : '') + (state.date === key ? ' is-selected' : ''),
				disabled: full,
				'aria-pressed': String(state.date === key),
				'aria-label': info.label + ', ' + note,
				onclick: (function (k) {
					return function () {
						state.date = k;
						state.people = 0;
						render();
						var panel = root.querySelector('.fivef-bk-panel');
						if (panel && window.innerWidth < 900) {
							panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
						}
					};
				})(key)
			}, [el('span', { class: 'fivef-bk-num', text: String(d) }), el('span', { class: 'fivef-bk-left', text: note })]));
		}
		wrap.appendChild(table);
		wrap.appendChild(el('p', { class: 'fivef-bk-legend', html: '<span class="fivef-bk-key is-open"></span> Open date &nbsp; <span class="fivef-bk-key is-full"></span> Booked' }));
		return wrap;
	}

	function renderPanel(t) {
		var panel = el('div', { class: 'fivef-bk-panel' });
		var info = state.date && findDate(state.type, state.date);
		if (!info) {
			panel.appendChild(el('h3', { class: 'fivef-bk-panel-title', text: 'Pick a date' }));
			panel.appendChild(el('p', { text: t.unit === 'weekend' ? 'Highlighted dates are the first day of each open hunt weekend. Choose one to see what’s left and reserve your spots.' : 'Highlighted dates are open mornings. Choose one to reserve it for your group.' }));
			return panel;
		}

		var max = t.mode === 'group' ? t.max : Math.min(t.max, info.left);
		var min = t.min;
		if (!state.people || state.people < min || state.people > max) {
			state.people = t.mode === 'group' ? min : Math.min(max, 1);
		}

		panel.appendChild(el('p', { class: 'fivef-bk-eyebrow', text: t.label }));
		panel.appendChild(el('h3', { class: 'fivef-bk-panel-title', text: info.label }));

		var options = [];
		for (var n = min; n <= max; n++) {
			options.push(el('option', { value: String(n), selected: n === state.people, text: n + (n === 1 ? ' hunter' : ' hunters') }));
		}
		var priceBox = el('div', { class: 'fivef-bk-price' });
		function paintPrice() {
			var q = quote(t, state.people, info.price, state.addon);
			var canAddon = !!(t.addon && state.people >= t.capacity);
			addonRow.hidden = !canAddon;
			priceBox.innerHTML = '';
			priceBox.appendChild(el('div', { class: 'fivef-bk-row' }, [el('span', { text: state.people + ' × ' + money(q.per) + (q.discount ? ' (all four spots)' : '') }), el('strong', { text: money(q.per * state.people) })]));
			if (q.addon) {
				priceBox.appendChild(el('div', { class: 'fivef-bk-row' }, [el('span', { text: 'Morning duck hunt add-on' }), el('strong', { text: money(t.addon.price) })]));
				priceBox.appendChild(el('div', { class: 'fivef-bk-row' }, [el('span', { text: 'Total' }), el('strong', { text: money(q.total) })]));
			}
			priceBox.appendChild(el('div', { class: 'fivef-bk-row is-due' }, [el('span', { text: cfg.online ? 'Deposit due today' : 'Deposit to confirm' }), el('strong', { text: money(q.deposit) })]));
			priceBox.appendChild(el('div', { class: 'fivef-bk-row' }, [el('span', { text: 'Remaining balance' }), el('strong', { text: money(q.balance) })]));
			if (t.mode === 'spots' && info.left >= t.capacity && state.people < t.capacity) {
				priceBox.appendChild(el('p', { class: 'fivef-bk-tip', text: 'Book all ' + t.capacity + ' spots together for ' + money(t.groupPrice) + ' per hunter.' }));
			}
			submit.textContent = cfg.online ? 'Pay ' + money(q.deposit) + ' deposit' : 'Request these dates';
		}

		var addonRow = el('label', { class: 'fivef-bk-check fivef-bk-addon', hidden: true }, t.addon ? [
			el('input', { type: 'checkbox', name: 'addon', value: '1', checked: !!state.addon, onchange: function (e) {
				state.addon = e.target.checked;
				paintPrice();
			} }),
			el('span', { html: '<strong>' + t.addon.label + '</strong> (+' + money(t.addon.price) + ')' })
		] : []);
		var errorBox = el('p', { class: 'fivef-bk-error', role: 'alert', hidden: true });
		var submit = el('button', { type: 'submit', class: 'wp-element-button fivef-bk-submit' });

		function field(label, input) {
			return el('label', { class: 'fivef-bk-field' }, [el('span', { text: label }), input]);
		}
		var form = el('form', { class: 'fivef-bk-form', novalidate: true }, [
			field(t.mode === 'group' ? 'Group size' : 'Hunters', el('select', {
				name: 'people',
				onchange: function (e) {
					state.people = +e.target.value;
					paintPrice();
				}
			}, options)),
			addonRow,
			priceBox,
			field('Your name', el('input', { name: 'name', type: 'text', autocomplete: 'name', required: true })),
			el('div', { class: 'fivef-bk-two' }, [
				field('Email', el('input', { name: 'email', type: 'email', autocomplete: 'email', required: true })),
				field('Phone', el('input', { name: 'phone', type: 'tel', autocomplete: 'tel', required: true }))
			]),
			field('Notes (optional)', el('textarea', { name: 'notes', rows: '3', placeholder: 'Names of the other hunters, questions, anything we should know' })),
			el('input', { type: 'text', name: 'company', tabindex: '-1', autocomplete: 'off', class: 'fivef-bk-hp', 'aria-hidden': 'true' }),
			el('label', { class: 'fivef-bk-check' }, [
				el('input', { type: 'checkbox', name: 'agree', value: '1', required: true }),
				el('span', { text: t.terms })
			]),
			errorBox,
			submit,
			el('p', { class: 'fivef-bk-fine', text: cfg.online ? 'You’ll pay securely on Stripe’s checkout page. Your spots are held for 30 minutes while you pay.' : 'No payment is taken online yet. Your dates are held and we’ll call you to take the deposit.' })
		]);
		form.addEventListener('submit', function (e) {
			e.preventDefault();
			errorBox.hidden = true;
			var fd = new FormData(form);
			var body = { type: state.type, date: state.date, people: state.people, addon: (state.addon && t.addon && state.people >= t.capacity) ? '1' : '' };
			fd.forEach(function (v, k) {
				body[k] = v;
			});
			body.agree = form.agree.checked ? '1' : '';
			if (!body.name || !body.email || !body.phone || !body.agree) {
				errorBox.textContent = 'Please fill in your name, email and phone, and tick the box.';
				errorBox.hidden = false;
				return;
			}
			submit.disabled = true;
			submit.textContent = 'One moment…';
			fetch(cfg.api + 'book', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(body)
			}).then(function (r) {
				return r.json().catch(function () { return {}; });
			}).then(function (res) {
				if (res.redirect) {
					window.location.href = res.redirect;
					return;
				}
				if (res.message) {
					state.success = res.message;
					state.date = null;
					load().then(function () {
						root.scrollIntoView({ behavior: 'smooth', block: 'start' });
					});
					return;
				}
				throw new Error(res.error || 'Something went wrong. Please call ' + cfg.phone + '.');
			}).catch(function (err) {
				errorBox.textContent = err.message;
				errorBox.hidden = false;
				submit.disabled = false;
				paintPrice();
				load(true);
			});
		});
		panel.appendChild(form);
		paintPrice();
		return panel;
	}

	function load(keepPanel) {
		return fetch(cfg.api + 'availability', { cache: 'no-store' })
			.then(function (r) { return r.json(); })
			.then(function (data) {
				state.data = data || {};
				if (!keepPanel) {
					render();
				}
			})
			.catch(function () {
				root.innerHTML = '';
				root.appendChild(el('p', { text: 'We couldn’t load the calendar. Please call ' + cfg.phone + ' to book.' }));
			});
	}

	load();
})();
