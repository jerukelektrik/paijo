(() => {
  const slider = document.querySelector('[data-paijo-slider]');
  if (!slider) return;

  const wrapper = slider.querySelector('[data-paijo-slider-wrapper]');
  const slides = slider.querySelectorAll('[data-paijo-slide]');
  const prevBtn = slider.querySelector('[data-paijo-slider-prev]');
  const nextBtn = slider.querySelector('[data-paijo-slider-next]');
  const dots = slider.querySelectorAll('[data-paijo-slider-dot]');

  if (slides.length <= 1) return;

  let currentIndex = 0;
  let intervalId = null;
  const autoplayDelay = 5000; // 5 seconds

  function updateSlider() {
    // Slide transition
    if (wrapper) {
      wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    // Update dots active state
    dots.forEach((dot, index) => {
      if (index === currentIndex) {
        dot.classList.add('bg-white', 'w-8');
        dot.classList.remove('bg-white/40', 'w-3');
        dot.setAttribute('aria-selected', 'true');
      } else {
        dot.classList.remove('bg-white', 'w-8');
        dot.classList.add('bg-white/40', 'w-3');
        dot.setAttribute('aria-selected', 'false');
      }
    });
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider();
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlider();
  }

  function goToSlide(index) {
    currentIndex = index;
    updateSlider();
  }

  function startAutoplay() {
    stopAutoplay();
    intervalId = setInterval(nextSlide, autoplayDelay);
  }

  function stopAutoplay() {
    if (intervalId) {
      clearInterval(intervalId);
    }
  }

  // Event Listeners
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      startAutoplay();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      startAutoplay();
    });
  }

  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      goToSlide(index);
      startAutoplay();
    });
  });

  // Touch navigation support
  let touchStartX = 0;
  let touchEndX = 0;

  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
    stopAutoplay();
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
    startAutoplay();
  }, { passive: true });

  function handleSwipe() {
    const swipeThreshold = 50;
    if (touchStartX - touchEndX > swipeThreshold) {
      nextSlide(); // Swiped left
    } else if (touchEndX - touchStartX > swipeThreshold) {
      prevSlide(); // Swiped right
    }
  }

  // Hover states to pause autoplay
  slider.addEventListener('mouseenter', stopAutoplay);
  slider.addEventListener('mouseleave', startAutoplay);

  // Initialize
  updateSlider();
  startAutoplay();
})();
