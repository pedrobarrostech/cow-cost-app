<?php
// src/AppBundle/Form/Type/CowType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CowType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('weight', TextType::class, array('label' => 'Type a weight'))
            ->add('age', TextType::class, array('label' => 'Type a age'))
            ->add('price', TextType::class, array('label' => 'Type a price'))
            ->add('save', SubmitType::class, array('label' => 'Submit', 'attr' => array('class'=>'waves-effect waves-light btn modal-trigger') ));

   }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cow',
            'method' => 'GET'
        ));
    }
}