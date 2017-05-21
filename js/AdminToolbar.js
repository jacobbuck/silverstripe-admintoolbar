(function() {
  // Bail on old browsers
  if (!document.querySelector || !window.addEventListener) return;

  var adminToolbar = document.querySelector('.AdminToolbar');
  var adminToolbarHide = document.querySelector('.AdminToolbarHide');

  // Remove toolbar if inside <iframe>
  if (window.self !== window.top) {
    adminToolbar.parentNode.removeChild(adminToolbar);
    return;
  }

  // Click handler for hide button
  adminToolbarHide.addEventListener('click', function(event) {
    event.preventDefault();
    adminToolbar.parentNode.removeChild(adminToolbar);
  });
}());
