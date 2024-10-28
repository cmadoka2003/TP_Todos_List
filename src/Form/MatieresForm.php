<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class MatieresForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder->setMethod('POST');

        $formBuilder
            ->add(
                'nom',
                TextType::class,
                [
                    "attr" => ["placeholder" => "Entrez le nom complet"],
                    "constraints" => [
                        new Assert\NotBlank(["message" => "nom complet a remplir"]),
                        new Assert\Length([
                            "min" => 2,
                            "max" => 255,
                            "minMessage" => "nom trop court",
                            "maxMessage" => "nom trop long"
                        ])
                    ]
            ])
            ->add(
                'matiere',
                TextType::class,
                [
                    "attr" => ["placeholder" => "Entrez la matiere"],
                    "constraints" => [
                        new Assert\NotBlank(["message" => "matiere a remplir"]),
                        new Assert\Length([
                            "min" => 2,
                            "max" => 255,
                            "minMessage" => "nom trop court",
                            "maxMessage" => "nom trop long"
                        ])
                    ]
            ])
            ->add(
                'note',
                TextType::class,
                [
                    "attr" => ["placeholder" => "Entrez la note"],
                    "constraints" => [
                        new Assert\NotBlank(["message" => "note a remplir"]),
                        new Assert\Length([
                            "min" => 2,
                            "max" => 255,
                            "minMessage" => "nom trop court",
                            "maxMessage" => "nom trop long"
                        ])
                    ]
            ])
            ->add(
                "Envoyer", 
                SubmitType::class, 
                [
                    "attr" => ["class" => "button"]
            ]);

        $formBuilder->get('nom')->setRequired(false);
        $formBuilder->get('matiere')->setRequired(false);
        $formBuilder->get('note')->setRequired(false);
    }
}