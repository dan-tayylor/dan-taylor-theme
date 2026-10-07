/**
 * Pillar Stack.
 *
 * @package dan_theme
 */

/* phpcs:disable */
document.addEventListener('DOMContentLoaded', () => {
	const stacks = Array.from(document.querySelectorAll('.pillar-stack-block'));

	if (!stacks.length) {
		return;
	}

	// Matches the breakpoint the stack itself is gated to, and the same
	// reduced-motion opt-out, as live queries so a resize or an OS
	// preference change is picked up without a reload.
	const stackable = window.matchMedia('(min-width: 768px)');
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

	const panelsOf = (stack) => Array.from(stack.querySelectorAll('.pillar-stack-panel'));
	const navItemsOf = (stack) => Array.from(stack.querySelectorAll('.pillar-stack-nav-item'));

	const setActive = (stack, index) => {
		navItemsOf(stack).forEach((item, itemIndex) => {
			item.classList.toggle('is-active', itemIndex === index);
		});
	};

	// Below the breakpoint, or with reduced motion, panels sit in normal
	// flow rather than stacking -- always show the first item as active
	// rather than leaving whatever the scroll handler last set.
	const clear = () => {
		stacks.forEach((stack) => setActive(stack, 0));
	};

	/*
	 * The site header is fixed, not part of document flow, so both the
	 * nav and the panels need to pin below it rather than at the very
	 * top of the viewport -- otherwise the header covers them. There's
	 * no reliable CSS token for its height (see .header-main, sized by
	 * its own padding rather than a fixed value), so it's measured here
	 * and written onto :root for pillar-stack.css to read back.
	 */
	const setHeaderOffset = () => {
		const header = document.querySelector('.site-header .header-main');
		const height = header ? header.offsetHeight : 80;
		document.documentElement.style.setProperty('--pillar-stack-offset', height + 'px');
		return height;
	};

	// The extra breathing room pillar-stack.css adds on top of the header
	// height, and the per-panel stagger that keeps each one from fully
	// covering the last -- both read back from there rather than
	// repeated as magic numbers here, so a panel counts as "arrived" at
	// the same point it visually reaches its own sticky resting place.
	const readPx = (name) =>
		parseFloat(getComputedStyle(document.documentElement).getPropertyValue(name)) || 0;
	const getStackGap = () => readPx('--pillar-stack-gap');
	const getStackStagger = () => readPx('--pillar-stack-stagger');

	// Panel index is 0-based, so this matches pillar-stack.css's
	// `top: offset + gap + (var(--i) * stagger)` for the same panel.
	const panelRestTop = (index) => headerOffset + stackGap + index * stackStagger;

	let headerOffset = setHeaderOffset();
	let stackGap = getStackGap();
	let stackStagger = getStackStagger();

	/*
	 * The nav and the panels are independent sticky elements, each
	 * released once ITS OWN containing block runs out of room below it
	 * -- which depends on the element's own height, not just its top
	 * offset. The nav is shorter than a panel, so left alone it
	 * releases before the last, most-staggered panel does: the nav
	 * visibly moves away first while that panel is still sitting in
	 * place behind it, instead of the two releasing together.
	 *
	 * Giving the nav's own box the same effective height as the last
	 * panel's (offset included) fixes that -- .pillar-stack-nav-spacer
	 * makes up the difference. Set per stack (not on :root, unlike the
	 * other custom properties above), since it depends on that
	 * instance's own content heights, which can differ block to block.
	 *
	 * There's no equivalent spacer making every PANEL's own release
	 * match too: that's achievable the same way, but only by giving
	 * each one extra invisible height, which shows up as extra blank
	 * space between the visible cards before they've started stacking.
	 * A panel's release landing a few pixels out of step with its
	 * neighbour was judged the lesser problem, so panels keep the
	 * plain --pillar-stack-gap between them at rest instead.
	 */
	const setNavSpacer = (stack) => {
		const nav = stack.querySelector('.pillar-stack-nav');
		const spacer = stack.querySelector('.pillar-stack-nav-spacer');
		const panels = panelsOf(stack);

		if (!nav || !spacer || !panels.length) {
			return;
		}

		// Cleared first so a previous measurement's spacer doesn't
		// inflate the nav height being measured just below -- otherwise
		// the correction could only ever grow across resizes, never
		// shrink back down.
		stack.style.removeProperty('--pillar-stack-nav-spacer');

		const lastIndex = panels.length - 1;
		const lastPanelBottom = panelRestTop(lastIndex) + panels[lastIndex].offsetHeight;
		const navBottom = headerOffset + stackGap + nav.offsetHeight;

		stack.style.setProperty('--pillar-stack-nav-spacer', Math.max(0, lastPanelBottom - navBottom) + 'px');
	};

	/*
	 * Trial: force every panel in a stack to the height of its tallest
	 * one, via min-height (see pillar-stack.css), so a panel with more
	 * copy than its neighbours no longer sticks out past whichever
	 * shorter panel stacks on top of it. Read back before setNavSpacer()
	 * runs, since that depends on the (now-equalised) last panel's real
	 * offsetHeight.
	 */
	const setPanelHeights = (stack) => {
		const panels = panelsOf(stack);

		if (!panels.length) {
			return;
		}

		// Cleared first for the same reason as setNavSpacer's own reset --
		// otherwise a previous measurement's min-height would inflate
		// every panel's offsetHeight being measured just below, and the
		// tallest could only ever grow across resizes, never shrink back
		// down to a genuinely shorter one.
		stack.style.removeProperty('--pillar-stack-panel-height');

		const tallest = Math.max(...panels.map((panel) => panel.offsetHeight));

		stack.style.setProperty('--pillar-stack-panel-height', tallest + 'px');
	};

	const paint = () => {
		if (!stackable.matches || reducedMotion.matches) {
			return;
		}

		stacks.forEach((stack) => {
			// Nothing to do for a stack that isn't on screen, which is most
			// of them on a long page.
			const bounds = stack.getBoundingClientRect();
			if (bounds.bottom < 0 || bounds.top > window.innerHeight) {
				return;
			}

			const panels = panelsOf(stack);

			/*
			 * A panel that has reached its own sticky resting place (top
			 * <= panelRestTop(index), with a little slack for sub-pixel
			 * rounding) has finished rising and is now pinned there,
			 * cascading over whatever came before it. The last such
			 * panel, in document order, is the one currently on top of
			 * the stack; until any panel has reached that point, the
			 * first one is showing.
			 */
			let activeIndex = 0;
			panels.forEach((panel, index) => {
				if (panel.getBoundingClientRect().top <= panelRestTop(index) + 1) {
					activeIndex = index;
				}
			});

			setActive(stack, activeIndex);
		});
	};

	let frame = null;

	const schedule = () => {
		// Coalesce a scroll's worth of events into one read per frame; each
		// pass calls getBoundingClientRect(), which forces layout.
		if (frame) {
			return;
		}

		frame = requestAnimationFrame(() => {
			frame = null;
			paint();
		});
	};

	const sync = () => {
		if (!stackable.matches || reducedMotion.matches) {
			clear();
			return;
		}

		paint();
	};

	stacks.forEach(setPanelHeights);
	stacks.forEach(setNavSpacer);

	/*
	 * Web fonts (Early Sans, loaded via Typekit) arrive asynchronously,
	 * after DOMContentLoaded, and swapping them in can reflow a panel's
	 * text -- measured directly, one panel's height changed by 22px
	 * once its font finished loading. Re-running the measurement once
	 * document.fonts confirms everything has loaded catches that;
	 * without it, a nav spacer sized off the last panel's pre-swap
	 * height would be wrong once the swap reflows it, and the nav
	 * would drift out of sync with that panel again. Same reasoning
	 * applies to setPanelHeights(), and it has to run first -- setNavSpacer()
	 * reads the last panel's offsetHeight, which setPanelHeights() may
	 * have just changed.
	 */
	if (document.fonts) {
		document.fonts.ready.then(() => {
			stacks.forEach(setPanelHeights);
			stacks.forEach(setNavSpacer);
		});
	}

	window.addEventListener('scroll', schedule, { passive: true });
	window.addEventListener('resize', () => {
		headerOffset = setHeaderOffset();
		stackGap = getStackGap();
		stackStagger = getStackStagger();
		stacks.forEach(setPanelHeights);
		stacks.forEach(setNavSpacer);
		schedule();
	});
	stackable.addEventListener('change', sync);
	reducedMotion.addEventListener('change', sync);

	/*
	 * A panel that's already been passed -- the visitor clicking back up
	 * to an earlier item -- is still within its own sticky range even
	 * though a later panel is drawn over it, so it's currently rendered
	 * pinned at headerOffset + stackGap same as the one on top. Reading
	 * its position with scrollIntoView() or getBoundingClientRect() at
	 * that point returns the STUCK position, not its place in the
	 * document, so the browser sees it as "already there" and doesn't
	 * scroll at all: that's the bug being fixed here. Toggling position
	 * to static for one measurement gets its real document position,
	 * unaffected by whether it happens to be stuck right now.
	 */
	const documentTopOf = (el) => {
		const previousPosition = el.style.position;
		el.style.position = 'static';
		const top = el.getBoundingClientRect().top + window.scrollY;
		el.style.position = previousPosition;
		return top;
	};

	// A nav item's link targets its panel's id, so it already works with
	// no JS at all -- this only takes over to animate the jump. Which
	// item ends up active is left to paint(), triggered by the scroll
	// this causes: setting it here too would just be overwritten by the
	// first paint() during the animation anyway, since that judges the
	// active panel from real position and the target hasn't arrived yet.
	stacks.forEach((stack) => {
		stack.querySelectorAll('.pillar-stack-nav-link').forEach((link) => {
			link.addEventListener('click', (event) => {
				const targetId = link.getAttribute('href').slice(1);
				const target = document.getElementById(targetId);

				if (!target) {
					return;
				}

				event.preventDefault();

				/*
				 * The fixed header covers content at every breakpoint (see
				 * pillar-stack.css's unconditional scroll-margin-top), not
				 * just while the stack itself is pinning, so headerOffset
				 * + stackGap applies regardless of stackable.matches. The
				 * per-panel stagger on top of that only means anything
				 * while panels are actually stacking, though -- below the
				 * breakpoint, or with reduced motion, every panel rests
				 * at the same plain offset, not its own staggered one.
				 */
				const targetIndex = Number(target.dataset.index) || 0;
				const offset = stackable.matches && !reducedMotion.matches
					? panelRestTop(targetIndex)
					: headerOffset + stackGap;

				window.scrollTo({
					top: documentTopOf(target) - offset,
					behavior: reducedMotion.matches ? 'auto' : 'smooth',
				});
			});
		});
	});

	sync();
});
/* phpcs:enable */
