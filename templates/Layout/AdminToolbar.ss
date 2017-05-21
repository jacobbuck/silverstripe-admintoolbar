<% require css("silverstripe-admintoolbar/css/AdminToolbar.css") %>
<% require javascript("silverstripe-admintoolbar/js/AdminToolbar.js") %>

<% if $BackgroundColor || $ForegroundColor %>
<style>.AdminToolbar {
  <% if $BackgroundColor %>background-color:$BackgroundColor;<% end_if %>
  <% if $ForegroundColor %>color:$ForegroundColor;<% end_if %>
}</style>
<% end_if %>

<div class="AdminToolbar">
  <% include AdminToolbarNav Nav=$PrimaryNav, Variant="primary" %>
  <% include AdminToolbarNav Nav=$SecondaryNav, Variant="secondary" %>
  <% include AdminToolbarHide %>
</div>
