<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger)
    {

    }

    public function load(ObjectManager $manager): void
    {
         $parent = $this->creatCategory('Informatique' , null , $manager);
      
         $this->creatCategory('Ordinateurs portables' , $parent , $manager);
         $this->creatCategory('Ecran' , $parent , $manager);
         $this->creatCategory('Souris' , $parent , $manager);

         $parent = $this->creatCategory('Mode' , null , $manager);
      
         $this->creatCategory('Homme' , $parent , $manager);
         $this->creatCategory('Femme' , $parent , $manager);
         $this->creatCategory('Enfant' , $parent , $manager);

        $manager->flush();
    }

    public function creatCategory(string $name , Categories $parent=null, ObjectManager $manager )
    {
        $category = new Categories();
        $category->setname($name);
        $category->setslug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter ,$category);
        $this->counter++;

        return $category;
    }
}
