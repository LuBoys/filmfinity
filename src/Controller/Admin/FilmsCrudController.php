<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class FilmsCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Films::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextEditorField::new('description'),
            AssociationField::new('genres')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            AssociationField::new('acteurs')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            AssociationField::new('producteurs')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            AssociationField::new('realisateurs')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            ];
    }
}
