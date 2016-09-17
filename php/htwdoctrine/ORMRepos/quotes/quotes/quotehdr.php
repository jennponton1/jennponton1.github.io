<?php

namespace Quotes;

/** @Entity * */
class Quotehdr extends BaseEntityClass {

    public function __construct() {
        parent::__construct();
    }

    /** @Column @Id* */
    protected $quotenbr;

    /** @Column @Id * */
    protected $revnbr;

    /** @Column * */
    protected $custid;

    /** @Column * */
    protected $addrid;

    /** @Column * */
    protected $slsper;

    /** @Column * */
    protected $issuedate;

    /** @Column * */
    protected $trkrate;

    /** @Column * */
    protected $railrate;

    /** @Column * */
    protected $carrier;

    /** @Column * */
    protected $shipvia;

    /** @Column * */
    protected $stateship;

    /** @Column * */
    protected $cityship;

    /** @Column * */
    protected $plant;

    /** @Column * */
    protected $adjft;

    /** @Column * */
    protected $quotetot;

    /** @Column * */
    protected $bftot;

    /** @Column * */
    protected $instr;

    /** @Column * */
    protected $fupdate;

    /** @Column * */
    protected $notes;

    /** @Column * */
    protected $rkey;

    /** @Column * */
    protected $resolv;

    /** @Column * */
    protected $rdate;

    /** @Column * */
    protected $altused;

    /** @Column * */
    protected $altid;

    /** @Column * */
    protected $shiptofname;

    /** @Column * */
    protected $shiptolname;

    /** @Column * */
    protected $shiptoaddr1;

    /** @Column * */
    protected $shiptoaddr2;

    /** @Column * */
    protected $shiptocity;

    /** @Column * */
    protected $shiptostate;

    /** @Column * */
    protected $shiptozip;

    /** @Column * */
    protected $shiptophone;

    /** @Column * */
    protected $shiptofax;

    /** @Column * */
    protected $email;

    /** @Column * */
    protected $openquote;

    /** @Column * */
    protected $confirmto;

    /** @Column * */
    protected $perent;

    /** @Column * */
    protected $perclosed;

    /** @Column * */
    protected $leadtime;

    /** @Column * */
    protected $linecntr;

    /** @Column * */
    protected $rchrg;

    /** @Column * */
    protected $crmname;

    /** @Column * */
    protected $ordnbr;

    /** @Column * */
    protected $tso;

    /** @Column * */
    protected $dto;

}
