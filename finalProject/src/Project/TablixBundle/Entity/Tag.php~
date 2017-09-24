<?php

namespace Project\TablixBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="page_tags")
 */

class Tag extends AbstractTaxonomy {
    
    /**
     * @ORM\ManyToMany(
     *      targetEntity = "Post",
     *      mappedBy = "tags"
     * )
     */
    
    protected $posts;
   
}
