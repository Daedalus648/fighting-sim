<?php

class Archer extends Character
{
    public $holdup = false;
    private $quiver = 4;

    public function __construct($name){
        parent::__construct($name);
        $this->damage /=2;
    }

    public function turn($target){
        $rand = rand(1, 2);
        if($this->quiver == 0){
            $status = $this->dagger($target);
        }
        else if($rand == 1 && $this->quiver >= 1 && !$this->holdup){
            $status = $this->buildUp();
        }
        else if($rand == 2 && $this->quiver >= 1 && !$this->holdup){
            $status = $this->attack($target);
        }
        else if($this->holdup = true){
            $status = $this->specialAttack($target);
        }
        return $status;
    }

    public function dagger($target){
        $dagger = $this->damage /2;
        $target->setHealthPoints($dagger);
        $target->isAlive();
        $status = "N'ayant plus de flèches, $this->name inflige à coup de dague à $target->name pour $this->damage points de dégâts. Il reste $target->healthPoints de vie à $target->name";
        return $status;
    }

    public function attack($target){
        $target->setHealthPoints($this->damage);
        $target->isAlive();
        $this->quiver -= 1;
        $status = "$this->name tire une simple flèche en direction de $target->name à qui il inflige $this->damage points de dommages, il reste $target->healthPoints points de vie à $target->name. Flèches restantes : $this->quiver";
        return $status;
    }
    public function doubleAttack($target){
        $target->setHealthPoints($this->damage);
        $target->isAlive();
        $doubleDamage = $this->damage * 2;
        $status = "$this->name tire deux flèches à la fois, infligeant $doubleDamage points de dommages à $target->name, à qui il reste $target->healthPoints points de vie. Flèches restantes : $this->quiver";
        return $status;
    }

    public function weakPoint($target){
        $rand = rand(15, 30) /10;
        $criticalHit = $this->damage * $rand;
        $target->setHealthPoints($this->damage);
        $target->isAlive();
        $status = "$this->name vise le point faible de $target->name à qui il inflige $criticalHit points de dommages ! Il reste $target->healthPoints à $target->name. Flèches restantes : $this->quiver";
        return $status;
    }

    public function buildUp(){
            $this->holdup = true;
            $status = "$this->name prépare une attaque dévastatrice !";
            return $status;
    }
        
    public function specialAttack($target){
        $rand = rand(1,2);
        if($rand == 1 && $this->quiver >= 2 && $this->holdup = true){
            $this->quiver -= 2;
            $status = $this->doubleAttack($target);
        }
        else if ($rand == 2 && $this->quiver >= 1 && $this->holdup = true){
            $this->quiver -= 1;
            $status = $this->weakPoint($target);
        }
        else{
            $this->quiver -= 1;
            $status = $this->weakPoint($target);
        }
        $this->holdup = false;
        return $status;
    }
}