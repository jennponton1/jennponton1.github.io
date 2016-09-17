<?php

namespace Archivedb;

/** @Entity */
class Apdoc {

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
    public $paydate;

    /** @Column */
    public $acct;

    /** @Column */
    public $batnbr;

    /** @Column */
    public $sub;

    /** @Column */
    public $refnbr;

    /** @Column */
    public $docdate;

    /** @Column */
    public $origamt;

    /** @Column */
    public $docbal;

    /** @Column */
    public $status;

    /** @Column */
    public $ponbr;

    /** @Column */
    public $invcnbr;

    /** @Column */
    public $invcdate;

    /** @Column */
    public $terms;

    /** @Column */
    public $discdate;

    /** @Column */
    public $discbal;

    /** @Column */
    public $duedate;

    /** @Column */
    public $pmtamt;

    /** @Column */
    public $disctkn;

    /** @Column */
    public $perpaid;

    /** @Column */
    public $nbrcycle;

    /** @Column */
    public $cycle;

    /** @Column */
    public $apyear;

    /** @Column */
    public $doc1099;

    /** @Column */
    public $perent;

    /** @Column */
    public $perclosed;
    /** @Column */
    public $vendid;
    /** @Column */
    public $docdesc;
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
    public $linecntr;
    /** @Column */
    public $rlsed;
    /** @Column */
    public $docclass;
    /** @Column */
    public $selflg;
    /** @Column */
    public $opendoc;
    /** @Column */
    public $current;

}
