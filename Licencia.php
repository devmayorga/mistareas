<?php

class Licencia
{
    public $IdLicencia ;
    public $UpdgradeCode ;
    public $StartDate ;
    public $EndDate ;
    private $DalSource = "Dal.php";
    private $Dal ;
    public $Activa ;

    function __construct($p_id = 0)
    {
        $this->IdLicencia = $p_id ;
        $this->Activa = true  ;
		
    }


    function ExpirarLicencia()
    {
        $this->Activa = false;
        // $licenciaProcesada = null;
        // include_once($DalSource);
        // $this->Dal = new Dal();
        // $this->Dal->CaducarLicencia($this->IdLicencia);
        // $licenciaProcesada = $this->Dal->getLicencia($this->IdLicencia);        
    }
    
}

?>