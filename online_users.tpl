<link rel="stylesheet" type="text/css" href="{$ONUS_PATH}onus_style.css">

{* online-users *}
<div id="online-users">

    <div class="online-users-open" id="overlay"; style="display: none;">
      <div>
      <div class="top-content-container">
      <div class="top-container-number">
        <div class="info-number-circle-badge">
          <span class="info-circle-badge">{$ONLINE_USERS_NB_CONNECTED+$ONLINE_USERS_NB_ANONYMOUS}</span>
        </div>
        <div class="open-line"></div>
        <div class="number-circle-badge">
          <span class="circle-badge">{$ONLINE_USERS_NB_ANONYMOUS}</span>
        </div>
        {if $ONLINE_USERS_NB_CONNECTED > 0}
        <div class="number-circle-badge">
          <span class="circle-badge">{$ONLINE_USERS_NB_CONNECTED}</span>
        </div>
        {/if}
      </div>
      <div class="top-container-text">
        <div class="toptext-right-badge">
          <text>{"Users online"|translate}</text>
        </div>
        <div class="open-line"></div>
        <div class="text-right-badge">
          <text>{"guests"|translate}</text>
        </div>
        {if $ONLINE_USERS_NB_CONNECTED > 0}
        <div class="text-right-badge">
          <text>{"registered users"|translate}</text>
        </div>
        {/if}
      </div>
      </div>
      {if $ONLINE_USERS_NB_CONNECTED > 0}
      <div class="open-user-list">
        <text>{$ONLINE_USERS_LIST}</text>
      </div>
      {/if}
      </div>
    </div>
        <div class="circle-container">
          <div class="icon-circle" id="icon-circle">
            <img src="plugins/online_users/online-icon.svg" alt="">
          </div>
          <div class="info-circle" style="display: flex;" id="infoCircle">
            <span class="info-circle-content">{$ONLINE_USERS_NB_CONNECTED+$ONLINE_USERS_NB_ANONYMOUS}</span>
          </div>
        </div>
</div>

{combine_script id='jquery.online-users' load='footer' require='jquery' path='plugins/online_users/script.js'}
