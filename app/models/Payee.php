<?php
/**
 * Description of payee
 *
 * @author Rana
 */
class Payee extends Eloquent
{
    protected $fillable = array('type');
    
    public function bill()
    {
        return $this->hasOne('Bill');
    }
    //any one of these two
    public function investments()
    {
        return $this->hasOne('Investment');
    }
    
    public function user()
    {
        return $this->hasOne('User');
    }
    
}
