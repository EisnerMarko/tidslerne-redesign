window.addEventListener('load', function () {
  const preloader = document.getElementById('preloader');
  const mainContent = document.getElementById('main-site');
  preloader.style.opacity = '0';
  setTimeout(() => {
    preloader.style.display = 'none';
    mainContent.style.display = 'block';
  }, 500);
});

document.getElementById('search-toggle').onclick = function() {
  document.getElementById('search-modal').classList.remove('hidden');
};
document.getElementById('search-close').onclick = function() {
  document.getElementById('search-modal').classList.add('hidden');
};
window.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') document.getElementById('search-modal').classList.add('hidden');
});
document.getElementById('search-modal').addEventListener('mousedown', function(e) {
  if (e.target === this) {
    this.classList.add('hidden');
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.getElementById('menu-toggle');
  const menuClose = document.getElementById('menu-close');
  const sideMenu = document.getElementById('side-menu');

  menuToggle.addEventListener('click', (event) => {
    event.stopPropagation();
    sideMenu.classList.remove('hidden');
    setTimeout(() => {
      sideMenu.classList.remove('-translate-x-full');
      sideMenu.classList.add('translate-x-0');
    }, 10);
  });

  menuClose.addEventListener('click', (event) => {
    event.stopPropagation();
    sideMenu.classList.add('-translate-x-full');
    sideMenu.classList.remove('translate-x-0');
    setTimeout(() => {
      sideMenu.classList.add('hidden');
    }, 300);
  });

  document.addEventListener('click', (event) => {
    if (!sideMenu.contains(event.target) && event.target.id !== 'menu-toggle') {
      sideMenu.classList.add('-translate-x-full');
      sideMenu.classList.remove('translate-x-0');
      setTimeout(() => {
        sideMenu.classList.add('hidden');
      }, 300);
    }
  });

  sideMenu.addEventListener('click', (event) => {
    event.stopPropagation();
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const dropdownToggles = document.querySelectorAll('button[id="dropdown-toggle"]');

  dropdownToggles.forEach((toggle) => {
    toggle.addEventListener('click', () => {
      dropdownToggles.forEach((otherToggle) => {
        if (otherToggle !== toggle) {
          const otherMenu = otherToggle.nextElementSibling;
          if (otherMenu && !otherMenu.classList.contains('hidden')) {
            otherMenu.style.height = '0px';
            setTimeout(() => {
              otherMenu.classList.add('hidden');
            }, 300);
            otherToggle.classList.remove('bg-[#9B2D5C]', 'text-white');
            otherToggle.classList.add('bg-white', 'text-black');
            const otherArrow = otherToggle.querySelector('span[id="dropdown-arrow"]');
            if (otherArrow) {
              otherArrow.classList.remove('text-white');
              otherArrow.classList.add('text-black');
            }
          }
        }
      });

      const dropdownMenu = toggle.nextElementSibling;
      if (dropdownMenu) {
        if (dropdownMenu.classList.contains('hidden')) {
          dropdownMenu.classList.remove('hidden');
          dropdownMenu.style.height = '0px';
          setTimeout(() => {
            dropdownMenu.style.height = `${dropdownMenu.scrollHeight}px`;
          }, 10);
        } else {
          dropdownMenu.style.height = '0px';
          setTimeout(() => {
            dropdownMenu.classList.add('hidden');
          }, 300);
        }

        toggle.classList.toggle('bg-[#9B2D5C]');
        toggle.classList.toggle('text-white');
        toggle.classList.toggle('bg-white');
        toggle.classList.toggle('text-black');

        const dropdownArrow = toggle.querySelector('span[id="dropdown-arrow"]');
        if (dropdownArrow) {
          dropdownArrow.classList.toggle('text-white');
          dropdownArrow.classList.toggle('text-black');
        }
      }
    });
  });
});