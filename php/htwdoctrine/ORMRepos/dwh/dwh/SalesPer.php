<?php

namespace Dwh;

/** @Entity @Table(name="salesper") */
class SalesPer extends BaseEntityClass {

    /** @Id @Column */
    protected $slsPerId;

    /** @Column */
    protected $lastName;

    /** @Column */
    protected $firstName;

    /** @Column */
    protected $addrId;

    /** @Column */
    protected $cmmnPct;

    /** @Column */
    protected $ptdSales;

    /** @Column */
    protected $ytdSales;

    /** @Column */
    protected $ptdCogs;

    /** @Column */
    protected $ytdCogs;

    /** @Column */
    protected $user1;

    /** @Column */
    protected $user2;

    /** @Column */
    protected $user3;

    /** @Column */
    protected $user4;

    /** @Column */
    protected $user5;

    /** @Column */
    protected $chkSum;

    /** @Column */
    protected $scrnNbr;

    /** @Column */
    protected $updUserId;

}
