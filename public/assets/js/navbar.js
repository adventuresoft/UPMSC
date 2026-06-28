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

  if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener("click", () => {
      dropdownMenu.classList.toggle("hidden");
      const svg = dropdownBtn.querySelector("svg");
      if (svg) svg.classList.toggle("rotate-180");
    });
  }

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

  // ── Sticky Header & Navbar on Scroll (30% less size) ──
  const setupStickyNavigation = () => {
    const header = document.querySelector(".gov-main-header");
    let desktopNav = null;
    document.querySelectorAll("nav").forEach(nav => {
      if (nav.querySelector(".nav-links")) {
        desktopNav = nav;
        nav.classList.add("main-sticky-navbar");
      }
    });

    const mobileHeader = document.querySelector(".md\\:hidden.sticky.top-0, .md\\:hidden.bg-\\[\\#046307\\]");
    if (mobileHeader) {
      mobileHeader.classList.add("mobile-sticky-header");
    }

    if (!header) return;

    let spacer = document.getElementById("sticky-header-spacer");
    if (!spacer) {
      spacer = document.createElement("div");
      spacer.id = "sticky-header-spacer";
      spacer.style.display = "none";
      header.parentNode.insertBefore(spacer, header);
    }

    const handleScroll = () => {
      if (window.scrollY > 50) {
        if (!document.body.classList.contains("is-scrolled")) {
          // Only count header height (top-bar hides when scrolled)
          let totalHeight = header.offsetHeight;
          if (desktopNav && window.getComputedStyle(desktopNav).display !== "none") {
            totalHeight += desktopNav.offsetHeight;
          } else if (mobileHeader && window.getComputedStyle(mobileHeader).display !== "none") {
            totalHeight += mobileHeader.offsetHeight;
          }
          spacer.style.height = totalHeight + "px";
          spacer.style.display = "block";
          document.body.classList.add("is-scrolled");
        }
      } else {
        if (document.body.classList.contains("is-scrolled")) {
          spacer.style.display = "none";
          document.body.classList.remove("is-scrolled");
        }
      }
    };

    window.addEventListener("scroll", handleScroll, { passive: true });
    handleScroll();
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", setupStickyNavigation);
  } else {
    setupStickyNavigation();
  }
