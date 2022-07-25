<?php

namespace App\DataFixtures\Provider;

class AddressProvider
{
    
    private $address = [
    "82 Rue des Archives",
    "33 Rue des Deux Ponts",
    "35 Avenue de L'Opéra",
    "6 Rue de Castiglione",
    "61 Avenue Pierre Mendès-France",
    "80 rue de charonne",
    "68 Rue des Dames",
    "21 rue Saint Nicolas",
    "6 rue Vivienne",
    "3 place Clément Ader",
    "81 rue Reaumur",
    "204 rue du faubourg saint antoine",
    "12 rue de Richelieu",
    "29 rue Mazarine",
    "16 place de la Madeleine",
    "106 Bd du Montparnasse",
    "22 rue Daguerre",
    "162 Bd du Montparnasse",
    "55 rue des Archives",
    "8 rue de Rochechouart",
    "123 rue Oberkampf",
    "11 R. des Petites Écuries",
    "45 Av. Kléber",
    "83 rue Daguerre",
    "232 boulevard Raspail",
    "15 place Richard Baret",
    "60 Rue de Verneuil",
    "9 PLACE DE LA MADELEINE",
    "34, rue Beaurepaire",
    "135 Rue Saint-Dominique",
    "18 rue Troyon",
    "31, AVENUE GEORGE V",
    "4 rue d'Assas" ,
    "20 Rue Rennequin",
    "9 rue Balzac",
    "4, rue des Grands Augustins",
    "186 rue du Château",
    "80, rue de Charonne",
    "39 rue de Bretagne",
    "5 rue Saint-Bernard",
    "136 rue du faubourg poissonière" ,
    "43 rue des petites écuries",
    "32 rue saint maur" ,
    "129 avenue parmentier" ,
    "33 rue de l'abbbé grégoire" ,
    "14 rue lobineau" ,
    "3 rue jouye-rouve",
    "10 rue alexandre dumas" ,
    "10 rue saulnier",
    "8 passage des panoramas",
    "3 rue des patriarches", 
    "52 rue saint-maur",
    "49 passage des panoramas" ,
    "27 rue d'hauteville",
    "6 rue Victor Hugo",
    "10 rue du grand prieuré",
    "128 rue du faubourg saint-martin" ,
    "41 rue de richelieu" ,
    "131 avenue parmentier",
    "95 rue d'Aboukir",
    "25 rue du Dragon",
    "Adresses Multiples : 112 Quai de Jemmapes",
    "25 avenue de monataigne" ,
    " 15-17 Quai de la Tournelle",
    "17 rue de beaujolais",
    "Place Louis Armand",
    "31 avnue George V",
    "228 rue de Rivoli" ,
    "251 Rue st Honoré",
    "29 rue Surcouf" ,
    "110 Gal de Valois",
    "121 Rue St Honoré",
    ];


    

  
    public function getRandomAddress()
    {
        return $this->address[array_rand($this->address)];
    }
}