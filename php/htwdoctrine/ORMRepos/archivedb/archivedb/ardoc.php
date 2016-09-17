<?php

namespace Archivedb;

/** @Entity */
class Ardoc {

    /** @Id @Column 
     * @GeneratedValue
     */
    public $id;

    /** @Column */
    public $arcdate;

    /** @Column */
    public $arcpernbr;
    /** @Column */
    public $arcdsn;

    /** @Column */
    public $doctype;
    /** @Column */
    public $refnbr;
    /** @Column */
    public $docdate;
    /** @Column */
    public $terms;
    /** @Column */
    public $cycle;
    /** @Column */
    public $nbrcycle;
    /** @Column */
    public $discdate;
    /** @Column */
    public $origdocamt;
    /** @Column */
    public $docbal;
    /** @Column */
    public $discbal;
    /** @Column */
    public $docdesc;
    /** @Column */
    public $duedate;
    /** @Column */
    public $aryear;
    /** @Column */
    public $discapplamt;
    /** @Column */
    public $applamt;
    /** @Column */
    public $cmmnpct;
    /** @Column */
    public $cmmnamt;
    /** @Column */
    public $ageclose;
    /** @Column */
    public $custordnbr;
    /** @Column */
    public $jobcounter;
    /** @Column */
    public $perent;
    /** @Column */
    public $perclosed;
    /** @Column */
    public $docsort;
    /** @Column */
    public $custid;
    /** @Column */
    public $perpost;
    /** @Column */
    public $user1;
    /** @Column */
    public $user2;
    /** @Column */
    public $user3;
    /** @Column */
    public $user4;
    /** @Column */
    public $batnbr;
    /** @Column */
    public $rlsed;
    /** @Column */
    public $linecntr;
    /** @Column */
    public $slsperid;
    /** @Column */
    public $docclass;
    /** @Column */
    public $opendoc;
    /** @Column */
    public $current;
    /** @Column */
    public $acct;
    /** @Column */
    public $sub;
    /** @Column */
    public $chksum;
    /** @Column */
    public $scrnnbr;
    /** @Column */
    public $upduserid;

}
