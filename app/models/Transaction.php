<?php
/**
 * Description of Transaction
 *
 * @author Rana
 */
class Transaction extends Eloquent 
{
    protected $fillable = array('type', 'amount');
    
    public function comments()
    {
        return $this->hasMany('User');
    }
}
