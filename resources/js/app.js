import '../scss/app.scss';

import './components/navigation-mobile.js';
import './components/scroll-effects.js';
import './components/theme-toggle.js';

const rangeInputs = Array.from(document.querySelectorAll('input[type="range"]'));

const updateRangeFill = (input) => {
  if (!input || input.max === '') {
    return;
  }

  const min = Number(input.min || 0);
  const max = Number(input.max || 100);
  const value = Number(input.value || min);
  const range = max - min;
  const percent = range > 0 ? ((value - min) / range) * 100 : 0;

  input.style.setProperty('--range-fill', `${Math.min(100, Math.max(0, percent))}%`);
};

rangeInputs.forEach((input) => {
  updateRangeFill(input);
  input.addEventListener('input', () => updateRangeFill(input));
  input.addEventListener('change', () => updateRangeFill(input));
});

const rangeForms = new Set(rangeInputs.map((input) => input.form).filter(Boolean));

rangeForms.forEach((form) => {
  form.addEventListener('reset', () => {
    window.requestAnimationFrame(() => {
      form.querySelectorAll('input[type="range"]').forEach((input) => updateRangeFill(input));
    });
  });
});

const founderGrid = document.querySelector('[data-founder-grid]');

if (founderGrid) {
  const controls = document.querySelector('[data-founder-controls]');
  const filterButtons = Array.from(controls?.querySelectorAll('[data-founder-filter]') || []);
  const searchInput = controls?.querySelector('[data-founder-search]');
  const sortSelect = controls?.querySelector('[data-founder-sort]');
  const cards = Array.from(founderGrid.querySelectorAll('[data-founder-card]'));
  let activeCategory = 'all';

  const getCardNumber = (card) => Number(card.dataset.founderNumber || 0);
  const getCardJoined = (card) => Number(card.dataset.founderJoined || 0);

  const sortCards = () => {
    const sortMode = sortSelect?.value || 'number';
    const sortedCards = [...cards].sort((a, b) => {
      if (sortMode === 'joined') {
        return getCardJoined(a) - getCardJoined(b) || getCardNumber(a) - getCardNumber(b);
      }

      return getCardNumber(a) - getCardNumber(b);
    });

    sortedCards.forEach((card) => founderGrid.append(card));
  };

  const applyFounderFilters = () => {
    const term = (searchInput?.value || '').trim().toLowerCase();

    cards.forEach((card) => {
      const categoryMatches = activeCategory === 'all' || card.dataset.founderCategory === activeCategory;
      const nameMatches = term === '' || (card.dataset.founderName || '').includes(term);

      card.hidden = !(categoryMatches && nameMatches);
    });

    sortCards();
  };

  filterButtons.forEach((button) => {
    button.addEventListener('click', () => {
      activeCategory = button.dataset.founderFilter || 'all';

      filterButtons.forEach((item) => {
        item.classList.toggle('is-active', item === button);
      });

      applyFounderFilters();
    });
  });

  searchInput?.addEventListener('input', applyFounderFilters);
  sortSelect?.addEventListener('change', applyFounderFilters);

  applyFounderFilters();
}
