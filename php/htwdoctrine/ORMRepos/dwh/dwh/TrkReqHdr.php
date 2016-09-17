<?php

namespace Dwh;

/** @Entity @Table(name="trkreqhdr") */
class TrkReqHdr extends BaseEntityClass {

    /** @Id @Column */
    protected $trkNbr;

    /** @Column */
    protected $siteId;

    /** @Column */
    protected $flatRate;

    /** @Column */
    protected $rateMile;

    /** @Column */
    protected $miles;

    /** @Column */
    protected $covered;

    /** @Column */
    protected $dateShip;

    /** @Column */
    protected $trkCo;

    /** @Column */
    protected $totalChrg;

    /** @Column */
    protected $fuelChrg;

    /** @Column */
    protected $tarp;

    /** @Column */
    protected $shipDirection;

    /** @Column */
    protected $comments;

}
