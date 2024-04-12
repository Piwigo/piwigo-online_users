{combine_css path="plugins/online_users/style.css"}
<style>
.online-users {
  text-align: left;
  margin: 20px;
  max-width: 400px;
}
</style>

<div class="online-users">
  <div class="online-users-connected">Membres en ligne : {$ONLINE_USERS_NB_CONNECTED}</div>
  <div class="online-users-anonymous">Invités en ligne : {$ONLINE_USERS_NB_ANONYMOUS}</div>
{if $ONLINE_USERS_NB_CONNECTED > 0}
  <div class="online-users-list">Actuellement en ligne : {$ONLINE_USERS_LIST}</div>
{/if}
</div>