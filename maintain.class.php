<?php
defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

class online_users_maintain extends PluginMaintain
{
  private $table;

  function __construct($plugin_id)
  {
    parent::__construct($plugin_id); // always call parent constructor

    global $prefixeTable;

    // Class members can't be declared with computed values so initialization is done here
    $this->table = $prefixeTable . 'online_users';
  }

  function install($plugin_version, &$errors=array())
  {
    // add a new table
    pwg_query('
CREATE TABLE IF NOT EXISTS `'. $this->table .'` (
  `user_uuid` varchar(255) not null,
  `last_visit` datetime not null,
  PRIMARY KEY (`user_uuid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8
;');
  }

  function activate($plugin_version, &$errors=array())
  {
  }

  function deactivate()
  {
  }

  function update($old_version, $new_version, &$errors=array())
  {
    $this->install($new_version, $errors);
  }

  function uninstall()
  {
    pwg_query('DROP TABLE `'. $this->table .'`;');
  }
}