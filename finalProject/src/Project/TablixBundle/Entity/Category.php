<?php

namespace Project\TablixBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="page_categories")
 */

class Category extends AbstractTaxonomy {
    
    /**
     * @ORM\OneToMany(
     *      targetEntity = "Post",
     *      mappedBy = "category"
     * )
     */
    protected $posts;


}
