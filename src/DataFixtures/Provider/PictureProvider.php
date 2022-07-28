<?php

namespace App\DataFixtures\Provider;

class PictureProvider
{
    
    private $picture = [
        "e4298e91e42d8c957fe418c0b5e2fd13.jpg",
        "ce8cb0c40ab8507c08689dabda29886e.jpg",
        "c8fdbcf10929cbe93e37db336182d3e0.jpg",
        "37816c8e93f5df628bdb122cbaf2e006.jpg",
        "318aaecbfaa80de9a3c7a10cedc4d029.jpg",
        "85b892327b9068e941978e0e9960a7bf.jpg",
    ];


    

  
    public function getRandomPicture()
    {
        return $this->picture[array_rand($this->picture)];
    }
}