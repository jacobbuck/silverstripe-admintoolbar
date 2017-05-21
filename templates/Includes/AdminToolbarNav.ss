<% if $Nav %>
  <ul class="AdminToolbarNav <% if $Variant %>AdminToolbarNav--$Variant<% end_if %>">
    <% loop $Nav %>
      <% include AdminToolbarNavItem %>
    <% end_loop %>
  </ul>
<% end_if %>
