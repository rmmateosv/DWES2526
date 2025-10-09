<?php
class Alumno{
    private $nombre;
    private $foto;
    private $sexo;
    private $fecha,$hora,$ciclo,$asig,$beca,$observ;

    public function __construct($nombre,$foto,$sexo,$fecha,$hora,$ciclo,$asig,$beca,$observ)
    {
        $this->nombre=$nombre;
        $this->foto =$foto;
        $this->sexo=$sexo;
        $this->fecha=$fecha;
        $this->hora=$hora;
        $this->ciclo=$ciclo;
        $this->asig=$asig;
        $this->beca=$beca;
        $this->observ=$observ;
        //Subir foto al servidor si hay fichero
        
    }

    public function mostrar(){
        echo '<table>';
        echo '<tr>';
        echo '<td>'.$this->nombre.'</td>';
        echo '<td><img src="../img/'.$this->foto.'"></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Fecha Matrícula:'.$this->fecha.'</td>';
        echo '<td>Hora Matrícula:'.$this->hora.'></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Ciclo:'.$this->ciclo.'</td>';
        echo '<td>Asignaturas:'.$this->asig.'></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Becas:'.$this->beca.'</td>';
        echo '<td>Observaciones:'.$this->observ.'></td>';
        echo '</tr>';
        echo '</table>';
    }
    

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of sexo
     */ 
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set the value of sexo
     *
     * @return  self
     */ 
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of ciclo
     */ 
    public function getCiclo()
    {
        return $this->ciclo;
    }

    /**
     * Set the value of ciclo
     *
     * @return  self
     */ 
    public function setCiclo($ciclo)
    {
        $this->ciclo = $ciclo;

        return $this;
    }

    /**
     * Get the value of asig
     */ 
    public function getAsig()
    {
        return $this->asig;
    }

    /**
     * Set the value of asig
     *
     * @return  self
     */ 
    public function setAsig($asig)
    {
        $this->asig = $asig;

        return $this;
    }

    /**
     * Get the value of beca
     */ 
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * Set the value of beca
     *
     * @return  self
     */ 
    public function setBeca($beca)
    {
        $this->beca = $beca;

        return $this;
    }

    /**
     * Get the value of observ
     */ 
    public function getObserv()
    {
        return $this->observ;
    }

    /**
     * Set the value of observ
     *
     * @return  self
     */ 
    public function setObserv($observ)
    {
        $this->observ = $observ;

        return $this;
    }
}
?>