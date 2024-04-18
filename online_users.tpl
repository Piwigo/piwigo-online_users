{combine_css path=$ONUS_PATH|cat:'style.css'}

{* online-users *}
<div class="online-users">

    <div class="online-users-open" id="overlay"; style="display: none;">

      <div>
        <div class="open-top-content">
          <div class="info-circle-open">
            <span>{$ONLINE_USERS_NB_CONNECTED+$ONLINE_USERS_NB_ANONYMOUS}</span>
          </div>
          <div class="open-online">{"Users online"|translate}
          </div>
        </div>
        <div class="open-line">
        </div>
          <div class="open-guests">
            <span>{$ONLINE_USERS_NB_ANONYMOUS}</span>
            <text>{"guests"|translate}</text>
          </div>
          {if $ONLINE_USERS_NB_CONNECTED > 0}
            <div class="open-list">
              <span>{$ONLINE_USERS_NB_CONNECTED}</span>
              <text>{"registered users"|translate}</text>
           </div>
            <div class="open-user-list">
              <text>{$ONLINE_USERS_LIST}</text>
            </div>
          {/if}
        </div>
      </div>
        {* open/close button *}
        <div class="circle-container">
          <div class="icon-circle" id="icon-circle">
            <img src="plugins/online_users/online-icon.svg" alt="">
          </div>

          <div class="info-circle" style="display: flex;" id="infoCircle">
            <span>{$ONLINE_USERS_NB_CONNECTED+$ONLINE_USERS_NB_ANONYMOUS}</span>
          </div>
        </div>
</div>

{combine_script id='jquery.online-users' load='footer' require='jquery' path='plugins/online_users/script.js'}
