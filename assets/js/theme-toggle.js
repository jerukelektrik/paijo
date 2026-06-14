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

  // Run initial theme check immediately (failsafe)
  setTheme(getTheme());

  // Use event delegation on document to handle clicks on any theme toggle button
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-paijo-theme-toggle]');
    if (btn) {
      e.preventDefault();
      const isDark = document.documentElement.classList.contains('dark');
      setTheme(isDark ? 'light' : 'dark');
    }
  });
})();
