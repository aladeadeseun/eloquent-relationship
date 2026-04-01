<?php

namespace App\Util;

use App\Interface\ValidationRuleInterface;

class Validator{
    private array $errors = [];

    function validate(object $object): void
    {
        //Instantiate a $reflector using new ReflectionClass($object)
        $reflector = new \ReflectionClass($object);
        //sdd($reflector);
        //Loop over the Attributes
        foreach($reflector->getProperties() as $property){
            //Get the attributes using $property->getAttributes(); (only if ValidationRuleInterface)
            $attributes = $property->getAttributes(
                ValidationRuleInterface::class,
                \ReflectionAttribute::IS_INSTANCEOF
            );
            //dd($attributes);

            //Loop over the Attributes
            foreach($attributes as $attribute){
                //Instantiate a ProperValidator instance using $attribute->getValidator();
                $validator = $attribute->newInstance()->getValidator();

                //Ask IF the property does not validate
                if(!$validator->validate($property->getValue($object))){
                    //Add the property to errors with a message
                    //dd("failed");
                    $this->errors[$property->getName()][] = sprintf("Invalid value for '%s' using '%s' validation.", $property->getName(), $attribute->getName());
                }
            }//end for each
        }//end for loop
        dd($this->errors);
    }
}