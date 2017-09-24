<?php

namespace Project\TablixBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Project\TablixBundle\Entity\Tag;


class TagsFixtures extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        
            $tagsList = array(
            '#follow', 
            '#tweegram', 
            '#happy', 
            '#summer', 
            '#instagramhub', 
            '#bestoftheday', 
            '#iphoneonly',
            '#followme', 
            '#christmas', 
            
        );
        
        foreach ($tagsList as $key => $name) {
            $Tag = new Tag();
            $Tag->setName($name);
            
            $manager->persist($Tag);
            $this->addReference('tag_'.$name, $Tag);
        }
        
        $manager->flush();
    }
    
        public function getOrder()
    {
        return 0;
    }



}
