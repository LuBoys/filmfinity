<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('imagefilm'),
            TextField::new('Titre', 'Type de l\'image'),
            ImageField::new('photo', 'Votre image')
                    ->setBasePath('assets/img/')
                    ->setUploadDir('public/assets/img')
                    ->setUploadedFileNamePattern('[randomhash].[extension]')
                    ->setRequired(true),
        ];
    }
    
}
