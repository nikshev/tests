<?php
/**
 * Event class
 */

class Event {

    /**
     * Type of event on submit
     */
    const ON_SUBMIT = 'onSubmit';

    /**
     * type of event
     * @var string
     */
    private $type;

    /**
     *  Additional parameters
     * @var mixed
     */
    private $source;

    /**
     * Link for object (where event fired)
     * @var object
     */
    private $target;

    /**
     * Constructor
     * @param $type
     * @param null $target
     * @param null $source
     */
    public function __construct($type, $target = NULL, $source = NULL) {
        $this->type = $type;
        $this->target = $target;
        $this->source = $source;
    }

    /**
     * Get event type
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Get additional parameters
     * @return mixed
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * Get object link
     * @return object|null
     */
    public function getTarget() {
        return $this->target;
    }

    /**
     * Set up object where event fired
     * @param object $target
     */
    public function setTarget($target) {
        $this->target = $target;
    }

    /**
     *
     * @return string
     */
    public function __toString() {
        return get_class($this).' type:'.$this->getType().'; target:'.get_class($this->getTarget()).'; source:'.sizeof($this->getSource()).'';
    }
}