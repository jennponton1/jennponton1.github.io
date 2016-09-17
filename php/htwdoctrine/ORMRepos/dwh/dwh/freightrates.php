<?php

namespace Dwh;

/** @Entity * */
class Freightrates extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Id 
      @Column * */
    protected $siteid;

    /** @Id 
      @Column * */
    protected $city;

    /** @Id 
      @Column * */
    protected $state;

    /** @Column * */
    protected $miles;

    /** @Column * */
    protected $rate;

    /** @Column * */
    protected $fuelpct;

    /** @Column * */
    protected $minfreight;

}
