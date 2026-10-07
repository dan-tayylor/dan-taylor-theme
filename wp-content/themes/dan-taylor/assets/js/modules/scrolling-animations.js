/**
 * Scrolling animations functionality.
 *
 * @package Dan Taylor 2026 Theme
 */

/* phpcs:disable */
document.addEventListener('DOMContentLoaded', () => {
  const gifs = document.querySelectorAll('.lazy-gif');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const gif = entry.target;
        gif.src = gif.dataset.gif;
        observer.unobserve(gif);
      }
    });
  });

  gifs.forEach(gif => observer.observe(gif));

  const revealTargets = document.querySelectorAll('.portfolio-slideshow, .fade-in-group');

  const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-in-view');
        revealObserver.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.2,
  });

  revealTargets.forEach(target => revealObserver.observe(target));
});
/* phpcs:enable */