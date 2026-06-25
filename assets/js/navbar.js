 const menuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  const hamburgerIcon = document.getElementById("hamburger-icon");
  const closeIcon = document.getElementById("close-icon");
  const dropdownBtn = document.getElementById("dropdownBtn");
  const dropdownMenu = document.getElementById("dropdownMenu");

  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("-translate-x-full");
      if (hamburgerIcon) hamburgerIcon.classList.toggle("hidden");
      if (closeIcon) closeIcon.classList.toggle("hidden");
    });

    const closeFrontendMobileMenu = () => {
      if (!mobileMenu.classList.contains("-translate-x-full")) {
        mobileMenu.classList.add("-translate-x-full");
        if (hamburgerIcon) hamburgerIcon.classList.remove("hidden");
        if (closeIcon) closeIcon.classList.add("hidden");
      }
    };

    window.addEventListener("scroll", (e) => {
      if (!mobileMenu.classList.contains("-translate-x-full")) {
        if (e.target && (mobileMenu.contains(e.target) || e.target === mobileMenu)) {
          return;
        }
        closeFrontendMobileMenu();
      }
    }, true);

    const handleFrontendOutsideTap = (e) => {
      if (!mobileMenu.classList.contains("-translate-x-full")) {
        if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
          closeFrontendMobileMenu();
        }
      }
    };

    document.addEventListener("touchstart", handleFrontendOutsideTap, true);
    document.addEventListener("click", handleFrontendOutsideTap, true);
  }

  dropdownBtn.addEventListener("click", () => {
    dropdownMenu.classList.toggle("hidden");
    dropdownBtn.querySelector("svg").classList.toggle("rotate-180");
  });

 let active = 'food';
  function setActive(cat) {
    active = cat;
    document.querySelectorAll('[data-panel]').forEach(p => {
      p.classList.toggle('hidden', p.getAttribute('data-panel') !== cat);
    });
    // Optional: style the active left link
    document.querySelectorAll('#categoryList [data-cat]').forEach(a => {
      const isActive = a.getAttribute('data-cat') === cat;
      a.classList.toggle('underline', isActive);
    });
  }
  function clearActive() {
    // keep current panel visible when mouse leaves the mega menu
    setActive(active);
  }
  // initialize once on load
  setActive(active);
