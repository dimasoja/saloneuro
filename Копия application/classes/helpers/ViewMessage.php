<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Show messages on the userside
 */
class ViewMessage
{

   private static $message;
   private static $adminMessage;

   private function  __construct() {}

   /**
    * Add message to the user view
    * @param String $message The message text
    * @param String $type The message type
    * @param Boolean $store Store message to session and show in the next call
    */
   public static function add( $message, $type = 'info' )
   {
      if( !self::$message )
      {
         self::$message = new stdClass();
         self::$message->text = $message;
         self::$message->type = $type;
      }
      else
      {
         if( !is_array(self::$message->text) )
         {
            self::$message->text = array(self::$message->text, $message);
         }
         else
         {
            array_push( self::$message->text, $message );
         }
      }

   }

   /**
    * Add message for admin
    * @param String $message
    * @param String $type
    */
   public static function adminMessage($message, $type = 'info', $store = false)
   {
      if( !self::$adminMessage )
      {
         self::$adminMessage = new stdClass();
         self::$adminMessage->text = $message;
         self::$adminMessage->type = $type;
      }
      else
      {
         if( !is_array(self::$adminMessage->text) )
         {
            self::$adminMessage->text = array(self::$adminMessage->text, $message);
         }
         else
         {
            array_push( self::$adminMessage->text, $message );
         }
      }
      if( $store ) Session::instance()->set('adminMesssage', self::$adminMessage);
   }

   public static function renderMessages()
   {
      $messages = ( Session::instance()->get('adminMesssage') ) ? Session::instance()->get('adminMesssage') : self::$adminMessage;
      if( $messages )
      {
         Session::instance()->delete('adminMesssage');
         $view = new View('scripts/messages/message');
         $view->type = $messages->type;
         $view->messages = $messages->text;
         return $view;
      }
      else
      {
         return '';
      }
   }

   public static function drawMessages()
   {
      if( self::$message )
      {
         $view = new View('scripts/helpers/message');
         $view->messageText = ( !is_array(self::$message->text) ) ? self::$message->text : implode('<br />', self::$message->text);
         $view->messageType = self::$message->type;
         Request::instance()->response .= $view;
         self::$message = null;
      }
   }

   public static function renderToView( &$target )
   {
      if( self::$message )
      {
         $view = new View('scripts/helpers/message');
         $view->messageText = ( !is_array(self::$message->text) ) ? self::$message->text : implode('<br />', self::$message->text);
         $view->messageType = self::$message->type;
         $target .= $view;
         self::$message = null;
      }
   }

}