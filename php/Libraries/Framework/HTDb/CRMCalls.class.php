<?php
/**
 * CRMCalls - Customer Relationship Management Calls class
 * Provides access to calls in the CRM database 
 * @package HTFramework
 * @subpackage HTDb
 */  
class CRMCalls extends DwhModel
{
  public $BeginDate;
  public $EndDate;
  public function __construct($inBeg='', $inEnd='')
  {
    $this->setDtRange($inBeg, $inEnd);
    DwhModel::__construct(); // must call parent constructor 
  }
  public function setDtRange($inBeg='', $inEnd='')
  {
    if($inBeg=='' || $inEnd=='')
    {
      $this->BeginDate = date('Y-m-d');
      $this->EndDate = date('Y-m-d');
    }
    else
    { 
      $mdy = explode('/', $inBeg);
      $tm = mktime(0, 0, 0, (int)$mdy[0], (int)$mdy[1], (int)$mdy[2]);
      $this->BeginDate = date('Y-m-d', $tm);
      $mdy = explode('/', $inEnd);
      $tm = mktime(0, 0, 0, (int)$mdy[0], (int)$mdy[1], (int)$mdy[2]);
      $this->EndDate = date('Y-m-d', $tm);
    }
  }
  protected $accessorNames = array(
  /* column / alias name  =>  accessor name */
    'id'    => 'Id',
    'SalesPer'  => 'SalesPer',
    'IsUserDeleted'   =>  'deleted',
    'created_by'   =>  'CreatedBy',
    'name'  => 'Subject',   // yes, name column is the "Subject" of the call
    'date_start'  =>  'CallDate',
    'parent_type'   => 'CallType',  // Can be 'Leads', 'Contacts', 'Accounts'
    'status'  => 'Status',
    'direction'   => 'Direction',
    'description' => 'Description',
    'duration_hours'  => 'DurationHours',
    'recipient' => 'Recipient',
    'IsCallDeleted' =>  'CallDel');
  protected function getOpenSQL()
  {
    return "   
   SELECT
      CONCAT_WS(\" \", u.first_name, u.Last_name, CONCAT(\"(\", u.user_name, \")\"))
       as SalesPer,
      c.id,
      u.deleted as IsUserDeleted,
      c.created_by,
      c.name,
      c.date_start,
      c.parent_type,
      c.status,
      c.direction,
      c.description,
      c.deleted as IsCallDeleted,
       CASE c.parent_type
        WHEN 'Accounts' THEN 
          CONCAT_WS(\" \", a.name, a.billing_address_city, a.billing_address_state)
        WHEN 'Leads'    THEN 
          CONCAT_WS(\" \", l.title, l.first_name, l.last_name, \", \", l.department)
        WHEN 'Contacts' THEN 
          CONCAT_WS(\" \", t.title, t.first_name, t.last_name, \", \", t.department)
      END as recipient
    FROM
      crm.calls c
      left join crm.users u on c.assigned_user_id = u.id
      left join crm.leads l on c.parent_id = l.id
      left join crm.contacts t on c.parent_id = t.id
      left join crm.accounts a on c.parent_id = a.id
    WHERE 
      c.deleted = 0
      and c.date_start <= '$this->EndDate'
      and c.date_start >= '$this->BeginDate'";
  }
  // This is a read only object
  protected function getInsertSQL($current)
  {
    return ""; 
  }
  protected function getUpdateSQL($current)
  {
    return ""; 
  }
  protected function getDeleteSQL($current)
  {
    return "";
  }
}

?>
