<?php
/*******************************************************************************
 *                       C O P Y R I G H T  (c) 2021
 *                    Darmor™  M O R R I S O N   I N C.
 *                             All Rights Reserved
 *******************************************************************************
/**
 * @file         CurlController.php
 * @author	     Darren Morrison
 * @copyright    2021
 * @brief        Communicate with API's on the web using PHP $_POST
 */
// Set flag that this is a parent file.
define( '_PEXEC', 1 );

$oCurlController = CurlController::GetInstance();
if(!$oCurlController->Engine()) { return false; }

final class CurlController {
    // Members - Single instance (singleton mode).
    private static $_instance;

    /**
     * Constructor.
     */
    public function __construct() { }
    /**
     * Destructor.
     */
    public function __destruct() { }
    /**
     * @return CurlController
     */
    final public static function GetInstance() : CurlController {
        if(!self::$_instance instanceof self) self::$_instance = new self();
        return self::$_instance;
    }

    // Methods - Controller.
    final public function Engine() : bool {
        // Init vars.
        $sUrl = 'www.xxxxxx.com/test';
        $aBody = [
            'Cmd' => '',
            'SessionId' => 'xxxxxxxxxxxx'
        ];
        // Send Request
        if(!$aResponse = CurlController::SendPostSync($aBody)) { return false; }

        // Do stuff with response.

        // Return Success.
        return true;
    }

    public static function SendPostSync($sUrl, $aBody) : string {
        // Prepare post.
        if(($ch = curl_init($sUrl)) === false) { return false; }
        if(!curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)) { return false; }
        if(!curl_setopt($ch, CURLOPT_POSTFIELDS, $aBody)) { return false; }

        // Execute.
        $sResult = curl_exec($ch);

        // Close Connection.
        curl_close($ch);

        // Return response.
        return json_decode($sResult, true);
    }
}