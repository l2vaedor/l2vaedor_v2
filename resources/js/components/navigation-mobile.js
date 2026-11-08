/**
 * ----------------------------------------
 * Mobile Navigation
 * ----------------------------------------
 */

document.addEventListener('DOMContentLoaded', () => {
  const mobileNav = document.querySelector('.nav--main');

  if (!mobileNav) {
    return;
  }

  const openButtons = document.querySelectorAll('.mobile-nav-toggle');
  const closeButtons = mobileNav.querySelectorAll('.nav__close');
  const submenuButtons = mobileNav.querySelectorAll(".mobile-nav__link[type='button']");

  const openMenu = () => {
    mobileNav.classList.add('is-open');
    document.body.classList.add('nav-open');

    openButtons.forEach((button) => {
      button.setAttribute('aria-expanded', 'true');
    });
  };

  const closeMenu = () => {
    mobileNav.classList.remove('is-open');
    document.body.classList.remove('nav-open');

    openButtons.forEach((button) => {
      button.setAttribute('aria-expanded', 'false');
    });
  };

  openButtons.forEach((button) => {
    button.addEventListener('click', openMenu);
  });

  closeButtons.forEach((button) => {
    button.addEventListener('click', closeMenu);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeMenu();
    }
  });

  mobileNav.addEventListener('click', (event) => {
    if (event.target === mobileNav) {
      closeMenu();
    }
  });

  mobileNav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      if (window.matchMedia('(max-width: 992px)').matches) {
        closeMenu();
      }
    });
  });

  submenuButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const item = button.closest('.mobile-nav__item');

      if (!item) {
        return;
      }

      item.classList.toggle('is-open');
      button.setAttribute('aria-expanded', item.classList.contains('is-open') ? 'true' : 'false');
    });
  });
});
