<?php

namespace Dwh;

/**
 * @Entity @Table(name="siteaddress")
 */
class SiteAddress {

    /**
     * @id @column(type="string")
     */
    private $siteId;

    /**
     * @column(type="integer")
     */
    private $rpTord;

    /**
     * @column(type="string")
     */
    private $lastName;

    /**
     * @column(type="string")
     */
    private $firstName;

    /**
     * @column(type="string")
     */
    private $addr1;

    /**
     * @column(type="string")
     */
    private $addr2;

    /**
     * @column(type="string")
     */
    private $city;

    /**
     * @column(type="string")
     */
    private $county;

    /**
     * @column(type="string")
     */
    private $state;

    /**
     * @column(type="string")
     */
    private $zip;

    /**
     * @column(type="string")
     */
    private $phone;

    /**
     * @column(type="string")
     */
    private $adminFName;

    /**
     * @column(type="string")
     */
    private $adminLName;

    /**
     * @column(type="string")
     */
    private $adminExt;

    /**
     * @column(type="string")
     */
    private $mgrFName;

    /**
     * @column(type="string")
     */
    private $mgrLName;

    /**
     * @column(type="string")
     */
    private $mgrExt;

    /** getters and setters * */
    public function getSiteId() {
        return $this->siteId;
    }

    public function setSiteId($siteId) {
        $this->siteId = $siteId;
    }

    public function getRpTord() {
        return $this->rpTord;
    }

    public function setRpTord($rpTord) {
        $this->rpTord = $rpTord;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getAddr1() {
        return $this->addr1;
    }

    public function setAddr1($addr1) {
        $this->addr1 = $addr1;
    }

    public function getAddr2() {
        return $this->addr2;
    }

    public function setAddr2($addr2) {
        $this->addr2 = $addr2;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCounty() {
        return $this->county;
    }

    public function setCounty($county) {
        $this->county = $county;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getAdminFName() {
        return $this->adminFName;
    }

    public function setAdminFName($adminFName) {
        $this->adminFName = $adminFName;
    }

    public function getAdminLName() {
        return $this->adminLName;
    }

    public function setAdminLName($adminLName) {
        $this->adminLName = $adminLName;
    }

    public function getAdminExt() {
        return $this->adminExt;
    }

    public function setAdminExt($adminExt) {
        $this->adminExt = $adminExt;
    }

    public function getMgrFName() {
        return $this->mgrFName;
    }

    public function setMgrFName($mgrFName) {
        $this->mgrFName = $mgrFName;
    }

    public function getMgrLName() {
        return $this->mgrLName;
    }

    public function setMgrLName($mgrLName) {
        $this->mgrLName = $mgrLName;
    }

    public function getMgrExt() {
        return $this->mgrExt;
    }

    public function setMgrExt($mgrExt) {
        $this->mgrExt = $mgrExt;
    }

}
