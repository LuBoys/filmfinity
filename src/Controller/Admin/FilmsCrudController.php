<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class FilmsCrudController extends AbstractCrudController
{
    // Ajoutez cette méthode à votre classe
    public static function getEntityFqcn(): string
    {
        return Films::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // ... autres champs ...
    
            AssociationField::new('acteurs')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            
        ];
    }
}


