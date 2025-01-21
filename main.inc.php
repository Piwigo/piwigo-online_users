<?php
/*
Plugin Name: Online Users
Version: auto
Description: Show, in the gallery, which users are currently online.
Plugin URI: auto
Author: plg
Author URI: https://piwigo.org
Has Settings: false
*/

// TODO
// * at logout, remove id-<user_id> from table
// * at login, remove the session-<session_id> from table (will be replaced by id-<user_id> afterwards)

defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

if (basename(dirname(__FILE__)) != 'online_users')
{
  add_event_handler('init', 'online_users_error');
  function online_users_error()
  {
    global $page;
    $page['errors'][] = 'Online Users folder name is incorrect, uninstall the plugin and rename it to "online_users"';
  }
  return;
}

// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+
global $prefixeTable;

define('ONUS_ID', basename(dirname(__FILE__)));
define('ONUS_PATH' , PHPWG_PLUGINS_PATH . ONUS_ID . '/');
define('ONUS_TABLE', $prefixeTable . 'online_users');

// +-----------------------------------------------------------------------+
// | Add event handlers                                                    |
// +-----------------------------------------------------------------------+

// init the plugin
add_event_handler('init', 'online_users_init');

/**
 * plugin initialization
 *   - check for upgrades
 *   - unserialize configuration
 *   - load language
 */
function online_users_init()
{
  global $user, $conf;

  load_language('plugin.lang', ONUS_PATH);

  $query = '
DELETE
  FROM `'.ONUS_TABLE.'`
  WHERE `last_visit` < SUBDATE(NOW(), INTERVAL 1 HOUR)
;';
  pwg_query($query);

  $user_uuid = 'id-'.$user['id'];
  if ($conf['guest_id'] == $user['id'])
  {
    if (!empty(session_id()))
    {
      $user_uuid = 'session-'.session_id();
    }
    elseif (!empty($_SERVER['REMOTE_ADDR']))
    {
      $user_uuid = 'ip-'.$_SERVER['REMOTE_ADDR'];
    }
    else
    {
      $user_uuid = 'undefined';
    }
  }

  $query = '
INSERT INTO
  `'.ONUS_TABLE.'` (`user_uuid`, `last_visit`)
  VALUES(\''.$user_uuid.'\', NOW())
  ON DUPLICATE KEY UPDATE `last_visit` = NOW()
;';
  pwg_query($query);
}

add_event_handler('loc_begin_page_tail', 'online_users_display');
function online_users_display()
{
  global $template, $conf;

  $template->set_filenames(array('online_users' => ONUS_PATH.'online_users.tpl'));

  $query = '
SELECT
    user_uuid
  FROM `'.ONUS_TABLE.'`
;';
  $online_users = query2array($query, null, 'user_uuid');

  $connected_users = array();
  $nb_anonymous = 0;
  foreach ($online_users as $online_user)
  {
    if (preg_match('/^id-(\d+)$/', $online_user, $matches))
    {
      $connected_users[] = $matches[1];
    }
    else
    {
      $nb_anonymous++;
    }
  }
  
  $template->assign(
    array(
      'ONLINE_USERS_NB_CONNECTED' => count($connected_users),
      'ONLINE_USERS_NB_ANONYMOUS' => $nb_anonymous,
      'ONUS_PATH' => ONUS_PATH,
    )
  );

  if (!empty($connected_users))
  {
    $query = '
SELECT
    '.$conf['user_fields']['username'].'
  FROM '.USERS_TABLE.'
  WHERE '.$conf['user_fields']['id'].' IN ('.implode(',', $connected_users).')
;';
    $usernames = query2array($query, null, 'username');
    $template->assign('ONLINE_USERS_LIST', join(', ', $usernames));
  }

  $template->pparse('online_users');
}