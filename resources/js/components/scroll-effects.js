const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

const revealSelectors = [
  '.hero--primary',
  '.hero--small',
  '.legacy-hero',
  '.page-hero',
  '[data-scroll-reveal]',
  '.legacy-section',
  '.card',
  '.feature',
  '.patch-notes',
  '.account-panel',
  '.account-dashboard__hero',
  '.account-character-row',
  '.account-note',
  '.account-package',
  '.account-table__row',
  '.account-reward-list > div',
  '.account-timeline > div',
].join(', ');

const parallaxConfigs = [
  { selector: '.hero-art', factor: 0.12 },
  { selector: '.legacy-frame', factor: 0.08 },
  { selector: '.legacy-crest', factor: 0.14 },
  { selector: '.legacy-scene', factor: 0.18 },
  { selector: '.archive-seal', factor: 0.08 },
];

const revealTargets = Array.from(document.querySelectorAll(revealSelectors));
const parallaxTargets = [];

document.documentElement.classList.add('has-motion');

const isInRevealRange = (element) => {
  const rect = element.getBoundingClientRect();
  const revealOffset = window.innerHeight * 0.08;

  return rect.top < window.innerHeight - revealOffset && rect.bottom > revealOffset;
};

const revealElement = (element, observer = null) => {
  element.classList.add('is-visible');
  observer?.unobserve(element);
};

revealTargets.forEach((element) => {
  element.classList.add('motion-reveal');
});

if (prefersReducedMotion.matches) {
  revealTargets.forEach((element) => {
    revealElement(element);
  });
} else {
  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          revealElement(entry.target, observer);
        });
      },
      {
        root: null,
        threshold: 0.01,
        rootMargin: '0px 0px -8% 0px',
      }
    );

    revealTargets.forEach((element) => {
      if (isInRevealRange(element)) {
        revealElement(element);
      } else {
        revealObserver.observe(element);
      }
    });
  } else {
    revealTargets.forEach((element) => {
      revealElement(element);
    });
  }
}

parallaxConfigs.forEach(({ selector, factor }) => {
  document.querySelectorAll(selector).forEach((element) => {
    element.classList.add('motion-parallax');
    parallaxTargets.push({ element, factor });
  });
});

if (!prefersReducedMotion.matches && parallaxTargets.length > 0) {
  let rafId = 0;

  const updateParallax = () => {
    rafId = 0;
    const viewportMid = window.innerHeight / 2;

    parallaxTargets.forEach(({ element, factor }) => {
      const rect = element.getBoundingClientRect();
      const elementMid = rect.top + rect.height / 2;
      const offset = (viewportMid - elementMid) * factor;

      element.style.setProperty('--motion-parallax-y', `${offset.toFixed(2)}px`);
    });
  };

  const scheduleUpdate = () => {
    if (rafId) {
      return;
    }

    rafId = window.requestAnimationFrame(updateParallax);
  };

  window.addEventListener('scroll', scheduleUpdate, { passive: true });
  window.addEventListener('resize', scheduleUpdate);
  window.addEventListener('load', scheduleUpdate);
  updateParallax();
}
