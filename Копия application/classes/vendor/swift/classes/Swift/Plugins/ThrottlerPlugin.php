<?php

/*
 Throttler plugin in Swift Mailer.
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 */

//@require 'Swift/Events/SendEvent.php';
//@require 'Swift/Plugins/BandwidthMonitorPlugin.php';
//@require 'Swift/Plugins/Sleeper.php';
//@require 'Swift/Plugins/Timer.php';

/**
 * Throttles the rate at which emails are sent.
 * @package Swift
 * @subpackage Plugins
 * @author Chris Corbyn
 */
class Swift_Plugins_ThrottlerPlugin
  extends Swift_Plugins_BandwidthMonitorPlugin
  implements Swift_Plugins_Sleeper, Swift_Plugins_Timer
{
  
  /** Flag for throttling in bytes per minute */
  const BYTES_PER_MINUTE = 0x01;
  
  /** Flag for throttling in emails per minute */
  const MESSAGES_PER_MINUTE = 0x10;
  
  /**
   * The Sleeper instance for sleeping.
   * @var Swift_Plugins_Sleeper
   * @access private
   */
  private $_sleeper;
  
  /**
   * The Timer instance which provides the timestamp.
   * @var Swift_Plugins_Timer
   * @access private
   */
  private $_timer;
  
  /**
   * The time at which the first email was sent.
   * @var int
   * @access private
   */
  private $_start;
  
  /**
   * The rate at which messages should be sent.
   * @var int
   * @access private
   */
  private $_rate;
  
  /**
   * The mode for throttling.
   * This is {@link BYTES_PER_MINUTE} or {@link MESSAGES_PER_MINUTE}
   * @var int
   * @access private
   */
  private $_mode;
  
  /**
   