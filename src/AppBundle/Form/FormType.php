<?php
namespace AppBundle\Form;


use AppBundle\Entity\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class FormType extends AbstractType{

  public function __construct(){
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {

	$builder
	->add('field1',EmailType::class, array('label'=>'Form Field 1'))
	->add('submit',SubmitType::class,array('label'=>'Submit Form'))
  ->add('get_away_from_form',SubmitType::class,array(
    'label'=>'Get away from form',
    'attr'=>array(
    'onclick'=>'{
      //IF THE USER CLICK THE NOT_SUBMIT BUTTON THE REQUIRED FIELD ARE DISABLED BEFORE THE SUBMIT HAPPENS
      e= \'form\';

      $(e).submit(
        function(event){
          event.preventDefault(); 
        }
      );  
      
      function disableReq(e){
        var disableReqDef = $.Deferred();
        var disableReqDefProm = disableReqDef.promise();
        requiredFields = $(e).find(\'[required="required"]\');
        requiredFields.each(function(){
          $(this).attr(\'required\',false);
        }); 

        disableReqDef.resolve();  
        return disableReqDefProm;
      }

      var dr = disableReq(e);

      $.when(
        e,
        dr,
        undefined
      ).done(function(e){
        $(e).submit(
          function(event){
            event.target.submit();
          }
        );
      });
    }'
    )
    ));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Entity'

    ));
  }

  public function getName()
  {
    return 'form';
  }	
}
?>