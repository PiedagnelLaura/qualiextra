<?php

namespace App\DataFixtures\Provider;

class PictureProvider
{
    
    private $picture = [
      
        "pexels-chan-walrus-941861.jpg",
        "pexels-chan-walrus-958545.jpg",
        "pexels-creative-vix-370984.jpg",
        "pexels-daria-shevtsova-704982.jpg",
        "pexels-elevate-1267320.jpg",
        "pexels-helena-lopes-696218.jpg",
        "pexels-life-of-pix-67468.jpg",
        "pexels-marcus-herzberg-1058277.jpg",
        "pexels-pixabay-260922.jpg",
        "pexels-pixabay-262047.jpg",
        "pexels-pixabay-262978.jpg",
    ];


    

  
    public function getRandomPicture()
    {
        return $this->picture[array_rand($this->picture)];
    }
}