(() => {
  const navToggle = document.querySelector('[data-paijo-nav-toggle]');
  const mobileNav = document.querySelector('[data-paijo-mobile-nav]');
  const searchToggle = document.querySelector('[data-paijo-search-toggle]');
  const searchPanel = document.querySelector('[data-paijo-search-panel]');

  function setExpanded(button, target, expanded) {
    if (!button || !target) return;
    button.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    if (expanded) {
      target.classList.remove('hidden');
    } else {
      target.classList.add('hidden');
    }
  }

  if (navToggle && mobileNav) {
    setExpanded(navToggle, mobileNav, false);
    navToggle.classList.remove('is-open');
    navToggle.addEventListener('click', () => {
      const expanded = navToggle.getAttribute('aria-expanded') === 'true';
      const willExpand = !expanded;
      
      // If expanding mobile menu, close search panel
      if (willExpand && searchToggle && searchPanel) {
        setExpanded(searchToggle, searchPanel, false);
      }
      
      setExpanded(navToggle, mobileNav, willExpand);
      navToggle.classList.toggle('is-open', willExpand);
    });
  }

  if (searchToggle && searchPanel) {
    setExpanded(searchToggle, searchPanel, false);
    searchToggle.classList.remove('is-open');
    searchToggle.addEventListener('click', () => {
      const expanded = searchToggle.getAttribute('aria-expanded') === 'true';
      const willExpand = !expanded;
      
      // If expanding search panel, close mobile menu
      if (willExpand && navToggle && mobileNav) {
        setExpanded(navToggle, mobileNav, false);
        navToggle.classList.remove('is-open');
      }
      
      setExpanded(searchToggle, searchPanel, willExpand);
      searchToggle.classList.toggle('is-open', willExpand);
      
      const input = searchPanel.querySelector('input[type="search"]');
      if (willExpand && input) {
        setTimeout(() => input.focus(), 50);
      }
    });
  }

  // Scroll and hover event tracking for transparent overlay header on front page
  const header = document.querySelector('[data-paijo-header-overlay]');
  if (header) {
    const headerBtns = header.querySelectorAll('[data-paijo-header-btn]');
    let isScrolled = false;
    let isHovered = false;

    const updateHeaderState = () => {
      if (isScrolled || isHovered) {
        // Glassmorphism state
        header.classList.remove('bg-transparent', 'text-white', 'border-b-0');
        header.classList.add('bg-black/50', 'backdrop-blur-md', 'text-white', 'border-b', 'border-white/10', 'shadow-[0_4px_30px_rgba(0,0,0,0.15)]');
        
        if (isScrolled) {
          header.classList.remove('absolute');
          header.classList.add('fixed');
        } else {
          header.classList.remove('fixed');
          header.classList.add('absolute');
        }

        headerBtns.forEach(btn => {
          btn.classList.remove('border-white/30', 'text-white', 'bg-transparent', 'hover:bg-white', 'hover:text-paijo-ink');
          btn.classList.add('border-white/15', 'text-white', 'bg-white/10', 'backdrop-blur-sm', 'hover:border-paijo-accent', 'hover:text-paijo-accent', 'hover:bg-white/20');
        });
      } else {
        // Transparent Overlay state
        header.classList.add('absolute', 'bg-transparent', 'text-white', 'border-b-0');
        header.classList.remove('fixed', 'bg-black/50', 'backdrop-blur-md', 'text-white', 'border-b', 'border-white/10', 'shadow-[0_4px_30px_rgba(0,0,0,0.15)]');
        
        headerBtns.forEach(btn => {
          btn.classList.remove('border-white/15', 'text-white', 'bg-white/10', 'backdrop-blur-sm', 'hover:border-paijo-accent', 'hover:text-paijo-accent', 'hover:bg-white/20');
          btn.classList.add('border-white/30', 'text-white', 'bg-transparent', 'hover:bg-white', 'hover:text-paijo-ink');
        });
      }
    };

    window.addEventListener('scroll', () => {
      isScrolled = window.scrollY > 50;
      updateHeaderState();
    }, { passive: true });

    header.addEventListener('mouseenter', () => {
      isHovered = true;
      updateHeaderState();
    });

    header.addEventListener('mouseleave', () => {
      isHovered = false;
      updateHeaderState();
    });

    // Run initially
    isScrolled = window.scrollY > 50;
    updateHeaderState();
  }
})();
