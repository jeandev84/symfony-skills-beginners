<?php
namespace App\Converter;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class CustomConverter
 * @package App\Converter
*/
class CustomConverter implements ParamConverterInterface
{

    /**
     * Stores the object in the request.
     *
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     *
     * @inheritDoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        // TODO: Implement apply() method.
        dump("apply called!");
        // return true;
    }

    /**
     * Checks if the object is supported.
     *
     * @return bool True if the object is supported, else false
     * @inheritDoc
    */
    public function supports(ParamConverter $configuration)
    {
        // TODO: Implement supports() method.
        dump("called supports!");
        return true; # false
    }
}