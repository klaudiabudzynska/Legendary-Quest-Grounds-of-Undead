<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Mobs
{

    /**
     * @var ArrayCollection
     */
    private $human;

    /**
     * @var ArrayCollection
     */
    private $darkMaster;

    public function __construct()
    {
        $this->human = new ArrayCollection();
        $this->darkMaster = new ArrayCollection();
    }


    /**
     * @return ArrayCollection
     */
    public function getHuman(): ArrayCollection
    {
        return $this->human;
    }

    public function addHuman(User $human): void
    {
        $this->human->add($human);
    }

    /**
     * @return ArrayCollection
     */
    public function getDarkMaster(): ArrayCollection
    {
        return $this->darkMaster;
    }

    public function addDarkMaster(User $user): void
    {
        $this->darkMaster->add($user);
    }





}