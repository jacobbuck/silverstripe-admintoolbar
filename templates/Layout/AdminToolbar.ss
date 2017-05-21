<% require css("silverstripe-admintoolbar/css/AdminToolbar.css") %>
<% require javascript("silverstripe-admintoolbar/js/AdminToolbar.js") %>

<div class="AdminToolbar" id="AdminToolbar" style="<% if $BackgroundColor %>background-color:$BackgroundColor;<% end_if %><% if $ForegroundColor %>color:$ForegroundColor;<% end_if %>">
  <% include AdminToolbarNav Nav=$PrimaryNav, Variant="primary" %>
  <% include AdminToolbarNav Nav=$SecondaryNav, Variant="secondary" %>
  <% include AdminToolbarHide %>
</div>
