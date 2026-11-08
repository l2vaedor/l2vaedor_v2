const storageKey = 'vaedor-theme';
const lightThemeClass = 'theme-light';
const toggles = Array.from(document.querySelectorAll('[data-theme-toggle]'));
const root = document.documentElement;

const getStoredTheme = () => {
  try {
    return window.localStorage.getItem(storageKey);
  } catch (error) {
    return null;
  }
};

const storeTheme = (theme) => {
  try {
    if (theme === 'light') {
      window.localStorage.setItem(storageKey, theme);
      return;
    }

    window.localStorage.removeItem(storageKey);
  } catch (error) {
    // Theme switching still works for the current page without storage.
  }
};

const setTheme = (theme, shouldStore = true) => {
  const isLight = theme === 'light';

  root.classList.toggle(lightThemeClass, isLight);

  toggles.forEach((toggle) => {
    toggle.setAttribute('aria-pressed', String(isLight));
    toggle.setAttribute('aria-label', isLight ? 'Switch to dark theme' : 'Switch to light theme');

    toggle.querySelectorAll('[data-theme-toggle-label]').forEach((label) => {
      label.textContent = isLight ? 'Light' : 'Dark';
    });
  });

  if (shouldStore) {
    storeTheme(theme);
  }
};

if (toggles.length > 0) {
  setTheme(getStoredTheme() === 'light' ? 'light' : 'dark', false);

  toggles.forEach((toggle) => {
    toggle.addEventListener('click', () => {
      setTheme(root.classList.contains(lightThemeClass) ? 'dark' : 'light');
    });
  });
}
