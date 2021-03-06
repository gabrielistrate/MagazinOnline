<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fas fa-newspaper')->addCssClass('btn btn-succes')->setLabel('Adauga Oferta');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fas fa-edit')->addCssClass('btn btn-warning')->setLabel('Modifica');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
                return $action->setIcon('fas fa-eye')->addCssClass('btn btn-info')->setLabel('Vizualizeaza');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
                return $action->setIcon('fas fa-trash')->addCssClass('btn btn-outline-danger')->setLabel('Sterge');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        $imageFile = Field::new('imageFile', 'Imagine de coperta')
            ->setFormType(VichImageType::class);
        $image = ImageField::new('Image', 'Imagine de coperta')
            ->setFormType(VichImageType::class);
        $fields = [
            IntegerField::new('id')
                ->hideOnForm(),
            TextField::new('title', 'Titlu'),
            TextareaField::new('description', 'Descriere'),
            DateField::new('date', 'Data'),
            AssociationField::new('product', 'Produs'),
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }
        return $fields;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters ->add('title')
                        ->add('date');
    }

}
