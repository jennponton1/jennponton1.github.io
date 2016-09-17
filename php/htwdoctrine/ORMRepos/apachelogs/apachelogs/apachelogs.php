<?php

namespace Apachelogs;

/** @Entity */
class Apachelogs extends BaseEntityClass {
    public function __construct() {
        parent::__construct();
    }

    /** @Id @Column */
    protected $reqdate;
    /** @Id @Column */
    protected $reqtime;
    /** @Id @Column */
    protected $clientip;
    /** @Column */
    protected $uri;
    /** @Column */
    protected $query;
    /** @Column */
    protected $responsecode;
    /** @Column */
    protected $size;

}
