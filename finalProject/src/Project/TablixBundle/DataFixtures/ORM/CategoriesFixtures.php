<?php

namespace Project\TablixBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Project\TablixBundle\Entity\Category;


class CategoriesFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) {
        
        $categoriesList = array(
            'Lorem' => 'Lorem Ipsum 1',
            'testowe' => 'Testowe Testy',
            'raz' => 'Raz dwa trzy',
            'piłka' => 'piłka nożna',
            'kosz' => 'koszykówka',

        );
        
        foreach ($categoriesList as $key => $name) {
            $Category = new Category();
            $Category->setName($name);
            
            $manager->persist($Category);
            $this->addReference('category_'.$key, $Category);
            
        }
        
        $manager->flush();
    }

    public function getOrder() {
        return 0;
    }



}
