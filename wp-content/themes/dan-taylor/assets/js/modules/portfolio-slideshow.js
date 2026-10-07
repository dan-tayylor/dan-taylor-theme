/**
 * Cycles portfolio card images on hover, sliding back to the start on mouse leave.
 *
 * @package Dan Taylor 2026 Theme
 */

/* phpcs:disable */
document.addEventListener('DOMContentLoaded', () => {
  const CYCLE_MS = 1800;
  const TRANSITION_MS = 600;
  const RESET_TRANSITION_MS = 400;
  const PARALLAX_OFFSET = '-30%';

  const slideshows = document.querySelectorAll('.portfolio-slideshow');

  slideshows.forEach((slideshow) => {
    const slides = Array.from(slideshow.querySelectorAll('.portfolio-slideshow__slide'));

    if (slides.length < 2) {
      return;
    }

    let activeIndex = 0;
    let intervalId = null;
    let resetTimeoutId = null;

    // Enables (or disables, when ms is null) the transform transition as one
    // shorthand assignment, so transition-property and duration never drift apart.
    // The cubic-bezier gives a pronounced ease-out glide into place, rather
    // than the much flatter default "ease" curve.
    const setTransition = (slide, ms) => {
      slide.style.transition = ms === null ? 'none' : `transform ${ms}ms cubic-bezier(0.16, 1, 0.3, 1)`;
    };

    // Moves a slide to a position with no animation, then flushes layout so the
    // next transition-enabled change on it actually animates from here.
    const jumpTo = (slide, transform, zIndex) => {
      setTransition(slide, null);
      slide.style.transform = transform;
      slide.style.zIndex = zIndex;
      void slide.offsetWidth;
    };

    const advance = () => {
      const prevSlide = slides[activeIndex];
      const nextIndex = (activeIndex + 1) % slides.length;
      const nextSlide = slides[nextIndex];

      // If prevSlide was interrupted mid-transition (e.g. hovered again right
      // after a reset), settle it fully in place first so the parallax
      // hand-off below always starts from a known, fully-covered position.
      jumpTo(prevSlide, 'translateX(0)', 2);

      setTransition(nextSlide, TRANSITION_MS);
      setTransition(prevSlide, TRANSITION_MS);
      nextSlide.style.zIndex = 2;
      prevSlide.style.zIndex = 1;
      nextSlide.style.transform = 'translateX(0)';
      prevSlide.style.transform = `translateX(${PARALLAX_OFFSET})`;

      activeIndex = nextIndex;

      clearTimeout(resetTimeoutId);
      resetTimeoutId = setTimeout(() => {
        jumpTo(prevSlide, 'translateX(100%)', 0);
      }, TRANSITION_MS);
    };

    const resetToStart = () => {
      clearTimeout(resetTimeoutId);

      if (activeIndex === 0) {
        return;
      }

      const outgoing = slides[activeIndex];
      const incoming = slides[0];

      // Settle outgoing fully in place first, in case it was still mid-arrival
      // (e.g. mouse left right after hovering in) — otherwise it starts its
      // exit partway across the frame, leaving a gap where nothing covers the
      // area behind it.
      jumpTo(outgoing, 'translateX(0)', 2);

      // Stage the first slide off-screen to the left so it can slide back in from there.
      jumpTo(incoming, 'translateX(-100%)', 2);

      setTransition(outgoing, RESET_TRANSITION_MS);
      setTransition(incoming, RESET_TRANSITION_MS);
      outgoing.style.zIndex = 1;
      outgoing.style.transform = 'translateX(100%)';
      incoming.style.transform = 'translateX(0)';

      activeIndex = 0;

      resetTimeoutId = setTimeout(() => {
        slides.forEach((slide, i) => {
          if (i !== 0) {
            jumpTo(slide, 'translateX(100%)', 0);
          }
        });
      }, RESET_TRANSITION_MS);
    };

    slideshow.addEventListener('mouseenter', () => {
      clearInterval(intervalId);
      advance();
      intervalId = setInterval(advance, CYCLE_MS);
    });

    slideshow.addEventListener('mouseleave', () => {
      clearInterval(intervalId);
      resetToStart();
    });
  });
});
/* phpcs:enable */
