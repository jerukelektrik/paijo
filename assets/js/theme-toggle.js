(() => {
  const getTheme = () => {
    if (localStorage.getItem('theme')) {
      return localStorage.getItem('theme');
    }
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  };

  const setTheme = (theme) => {
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
    }
  };

  const closeHeaderPanels = () => {
    const navToggle = document.querySelector('[data-paijo-nav-toggle]');
    const mobileNav = document.querySelector('[data-paijo-mobile-nav]');
    const searchToggle = document.querySelector('[data-paijo-search-toggle]');
    const searchPanel = document.querySelector('[data-paijo-search-panel]');

    if (navToggle && mobileNav) {
      navToggle.setAttribute('aria-expanded', 'false');
      mobileNav.classList.add('hidden');
      navToggle.classList.remove('is-open');
    }

    if (searchToggle && searchPanel) {
      searchToggle.setAttribute('aria-expanded', 'false');
      searchPanel.classList.add('hidden');
      searchToggle.classList.remove('is-open');
    }
  };

  const animateThemeSwitch = () => {
    document.documentElement.classList.add('theme-transition');
    window.setTimeout(() => {
      document.documentElement.classList.remove('theme-transition');
    }, 500);
  };

  // Run initial theme check immediately (failsafe)
  setTheme(getTheme());

  // Use event delegation on document to handle clicks on any theme toggle button
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-paijo-theme-toggle]');
    if (btn) {
      e.preventDefault();
      const isDark = document.documentElement.classList.contains('dark');
      animateThemeSwitch();
      setTheme(isDark ? 'light' : 'dark');
      closeHeaderPanels();
    }
  });
})();
