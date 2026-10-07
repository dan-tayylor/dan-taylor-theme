/**
 * Reveals the header logo/title once the hero's own branding scrolls out of view.
 *
 * @package Dan Taylor 2026 Theme
 */

/* phpcs:disable */
document.addEventListener('DOMContentLoaded', () => {
  const header = document.getElementById('masthead');
  const headerBranding = document.getElementById('header-branding');
  const heroBranding = document.getElementById('hero-branding');

  if (!header || !headerBranding || !heroBranding) {
    return;
  }

  const observer = new IntersectionObserver(([entry]) => {
    const scrolledPastHero = !entry.isIntersecting;

    header.classList.toggle('is-scrolled', scrolledPastHero);
    headerBranding.classList.toggle('is-visible', scrolledPastHero);
  }, {
    threshold: 0,
    rootMargin: `-${header.offsetHeight}px 0px 0px 0px`,
  });

  observer.observe(heroBranding);
});
/* phpcs:enable */
