<?php

namespace Dwh;

/** @Entity  */
class AcctPeriods {

    /** @Id @Column */
    public $perid;

    /** @Column */
    public $pernbr;

    /** @Column */
    public $fiscyear;

    /** @Column */
    public $perclose;

    /** @Column */
    public $perend;

}
