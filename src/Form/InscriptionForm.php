<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder->setMethod('POST')->setAttribute('class', 'form-class');

        $formBuilder
        ->add(
            'email',
            EmailType::class,
            [
                "attr" => ["placeholder" => "Entrez un email"],
                "constraints" => [
                    new Assert\Email(["message" => "Email invalidé!"]),
                    new Assert\NotBlank(["message" => "Email a remplir"])
                ]
        ])
        ->add(
            'password',
            PasswordType::class,
            [
                "attr" => ["placeholder" => "Entrez un mot de passe"],
                "constraints" => [
                    new Assert\NotBlank(["message" => "mot de passe a remplir"]),
                    new Assert\Length([
                        "min" => 2,
                        "max" => 255,
                        "minMessage" => "mot de passe trop court",
                        "maxMessage" => "mot de passe trop long"
                    ])
                ]
            ])
        ->add(
            "Envoyer", 
            SubmitType::class, 
            [
                "attr" => ["class" => "button"]
        ]);

        $formBuilder->get('email')->setRequired(false);
        $formBuilder->get('password')->setRequired(false);

        // $clubs = ["Paris" => "paris", "Lyon" => "lyon", "Marseille" => "marseille"];
        // $formBuilder->add("clubs", ChoiceType::class, ["choices" => $clubs]);
    }
}