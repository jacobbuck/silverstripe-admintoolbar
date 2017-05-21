(function() {
  var adminToolbar = document.getElementById('AdminToolbar');
  var adminToolbarHide = document.getElementById('AdminToolbarHide');

  // Click handler for hide button
  adminToolbarHide.addEventListener('click', function(event) {
    event.preventDefault();
    adminToolbar.parentNode.removeChild(adminToolbar);
  });
}());
