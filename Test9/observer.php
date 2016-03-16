<?php
/**
 * Observer class
 */

require_once("event.php");
interface EventHandler {
    function handler(Event $event);
}


/**
 * Class Observer (Event manager)
 */

class Observer {

    /**
     * @var Observer
     */
    private static $inst = NULL;

    /**
     * @var type
     */
    private $observers = array();


    final private function __construct() { }

    /**
     *
     * @return Observer
     */
    private static function getInstance() {
        if(is_null(self::$inst)) {
            self::$inst = new self();
        }
        return self::$inst;
    }

    /**
     * Add observer
     * @param string $type
     * @param EventHandler $observer
     */
    public static function addObserver($type, EventHandler $observer) {
        $instance = self::getInstance();
        if(isset($instance->observers[$type])) {
            $instance->observers[$type] = array();
        }
        $instance->observers[$type][] = $observer;
    }

    /**
     * Remove observer
     * @param string $type
     * @param EventHandler $observer
     */
    public static function removeObserver($type, EventHandler $observer) {
        $instance = self::getInstance();
        if(isset($instance->observers[$type])) {
            $data = array();
            foreach($instance->observers[$type] as $obs) {
                if($observer == $obs) {
                    continue;
                }
                $data[] = $obs;
            }
            $instance->observers[$type] = $data;
        }
    }

    /**
     * Event notification
     * @param Event $event
     */
    public static function notify(Event $event) {
        $instance = self::getInstance();
        $type = $event->getType();
        if(isset($instance->observers[$type])) {
            if(is_null($event->getTarget())) {
                $event->setTarget($instance);
            }
            foreach($instance->observers[$type] as $obs) {
                $obs->handler($event);
            }
        }
    }
}