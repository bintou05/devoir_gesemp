<?php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Approvisionnement;
use App\Entity\Article;
use App\Entity\DetailApprovisionnement;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable; // Nécessaire pour les dates

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Création des Fournisseurs
        $fournisseurs = [];
        $fournisseurs['textiles'] = (new Fournisseur())->setNom('Textiles Dakar SARL');
        $fournisseurs['mercerie'] = (new Fournisseur())->setNom('Mercerie Centrale');
        $fournisseurs['tissus'] = (new Fournisseur())->setNom('Tissus Premium');

        foreach ($fournisseurs as $fournisseur) {
            $manager->persist($fournisseur);
        }
        
        // 2. Création d'Articles factices
        $articleA = (new Article())->setNom('Fil à coudre polyester')->setPrixUnitaire(1000);
        $articleB = (new Article())->setNom('Tissu Wax imprimé')->setPrixUnitaire(5000);
        $manager->persist($articleA);
        $manager->persist($articleB);

        // 3. Données des 5 Approvisionnements (basé sur la maquette)
        $approvisionnementsData = [
            ['ref' => 'APP-2023-001', 'date' => '15/04/2023', 'fournisseur' => $fournisseurs['textiles'], 'montant' => 750000, 'statut' => 'Reçu'],
            ['ref' => 'APP-2023-002', 'date' => '10/04/2023', 'fournisseur' => $fournisseurs['mercerie'], 'montant' => 320000, 'statut' => 'Reçu'],
            ['ref' => 'APP-2023-003', 'date' => '05/04/2023', 'fournisseur' => $fournisseurs['tissus'], 'montant' => 450000, 'statut' => 'Reçu'],
            ['ref' => 'APP-2023-004', 'date' => '01/04/2023', 'fournisseur' => $fournisseurs['textiles'], 'montant' => 680000, 'statut' => 'Reçu'],
            ['ref' => 'APP-2023-005', 'date' => '25/03/2023', 'fournisseur' => $fournisseurs['mercerie'], 'montant' => 520000, 'statut' => 'Reçu'],
        ];

        foreach ($approvisionnementsData as $data) {
            $appro = new Approvisionnement();
            $appro->setReference($data['ref'])
                  ->setDate(DateTimeImmutable::createFromFormat('d/m/Y', $data['date']))
                  ->setFournisseur($data['fournisseur'])
                  ->setMontantTotal($data['montant'])
                  ->setStatut($data['statut']);

            $manager->persist($appro);

            // Création d'un DetailApprovisionnement factice
            $detail = new DetailApprovisionnement();
            $detail->setApprovisionnement($appro)
                   ->setArticle($articleA)
                   ->setQuantite(rand(10, 50))
                   ->setPrixAchat($data['montant']);
            $manager->persist($detail);
        }

        $manager->flush(); 
    }
}