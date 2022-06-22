<?php

class Checks extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $check_id;

    /**
     *
     * @var string
     */
    public $datetime;

    /**
     *
     * @var string
     */
    public $http;

    /**
     *
     * @var integer
     */
    public $try_no;

    /**
     *
     * @var integer
     */
    public $url_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("url_checker");
        $this->setSource("checks");
        $this->belongsTo('url_id', '\Urls', 'url_id', ['alias' => 'Urls']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Checks[]|Checks|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Checks|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
