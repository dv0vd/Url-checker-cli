<?php

class Urls extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $url_id;

    /**
     *
     * @var integer
     */
    public $freq;

    /**
     *
     * @var integer
     */
    public $repeats;

    /**
     *
     * @var string
     */
    public $datetime;

    /**
     *
     * @var string
     */
    public $url;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("url_checker");
        $this->setSource("urls");
        $this->hasMany('url_id', 'Checks', 'url_id', ['alias' => 'Checks']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Urls[]|Urls|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Urls|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
