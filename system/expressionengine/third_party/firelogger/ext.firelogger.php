<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once PATH_THIRD . 'firelogger/config.php';

/**
 * FireLogger Extension Class for ExpressionEngine 2
 *
 * @package   FireLogger for ExpressionEngine
 * @author    Tim Kelty <tkelty@fusionary.com>
 */
class Firelogger_ext {

  var $name = FIRELOGGER_NAME;
  var $version = FIRELOGGER_VER;
  var $description = FIRELOGGER_DESC;
  var $settings_exist = 'n';
  var $docs_url = FIRELOGGER_DOCS;

  /**
   * Extension constructor
   */
  function __construct()
  {
    // get EE global instance
    $this->EE =& get_instance();

  }

  /**
   * Activate Extension
   */
   function activate_extension()
    {
      $this->EE->db->insert('extensions', array(
        'class'    => 'Firelogger_ext',
        'method'   => 'load_firelogger',
        'hook'     => 'sessions_start',
        'settings' => '',
        'priority' => 1,
        'version'  => $this->version,
        'enabled'  => 'y'
      ));
  }

  /**
   * Update Extension
   */
  function update_extension($current = FALSE)
  {
    if (! $current || $current == $this->version)
    {
      return FALSE;
    }

    // if (version_compare($current, '0.1.0', '<'))
    // {
    // updates here
    // }

    $this->EE->db->where('class', 'Firelogger_ext');
    $this->EE->db->update('extensions', array('version' => $this->version));
  }

  /**
   * Delete extension
   */
  function disable_extension()
  {
    $this->EE->db->where('class', 'Firelogger_ext');
    $this->EE->db->delete('exp_extensions');
  }

  /**
   * Load FireLogger
   */
  function load_firelogger()
  {
    require_once PATH_THIRD . 'firelogger/lib/firelogger_php/firelogger.php';
    flog("FireLogger Enabled");
  }

}
