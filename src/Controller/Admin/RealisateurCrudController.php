<?php

namespace App\Controller\Admin;

use App\Entity\Realisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class RealisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Realisateur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'), 
            TextField::new('nickname'), 
            AssociationField::new('films')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
    
}
