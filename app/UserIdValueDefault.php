<?php
namespace App;

final class UserIdValueDefault
{
    protected static $USERID;

    public function __construct()
    {
        self::$USERID = Auth::id();
    }

    public static function AssignUserID(){

    }
}
