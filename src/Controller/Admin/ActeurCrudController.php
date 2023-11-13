<?php

namespace App\Controller\Admin;

use App\Entity\Acteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ActeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Acteur::class;
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
