(function () {
  var body = document.body;
  var mobileOpenButtons = document.querySelectorAll('[data-open-mobile]');
  var mobileCloseButtons = document.querySelectorAll('[data-close-mobile]');
  var sidebarOverlay = document.querySelector('[data-sidebar-overlay]');
  var collapseButton = document.querySelector('[data-toggle-collapse]');

  function closeMobileSidebar() {
    body.classList.remove('mobile-sidebar-open');
    if (sidebarOverlay) {
      sidebarOverlay.classList.add('hidden');
    }
  }

  mobileOpenButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      body.classList.add('mobile-sidebar-open');
      if (sidebarOverlay) {
        sidebarOverlay.classList.remove('hidden');
      }
    });
  });

  mobileCloseButtons.forEach(function (btn) {
    btn.addEventListener('click', closeMobileSidebar);
  });

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', closeMobileSidebar);
  }

  if (collapseButton) {
    collapseButton.addEventListener('click', function () {
      body.classList.toggle('sidebar-collapsed');
    });
  }

  var menuButtons = document.querySelectorAll('[data-menu-button]');
  menuButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var panelId = btn.getAttribute('data-menu-button');
      var panel = document.querySelector('[data-menu-panel="' + panelId + '"]');
      if (!panel) return;
      var isHidden = panel.classList.contains('hidden');

      document.querySelectorAll('[data-menu-panel]').forEach(function (p) {
        p.classList.add('hidden');
      });

      if (isHidden) {
        panel.classList.remove('hidden');
      }
    });
  });

  document.addEventListener('click', function (event) {
    var target = event.target;
    if (!(target instanceof Element)) return;
    if (target.closest('[data-menu-wrap]')) return;
    document.querySelectorAll('[data-menu-panel]').forEach(function (panel) {
      panel.classList.add('hidden');
    });
  });
})();
