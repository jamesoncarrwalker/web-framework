<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/11/2019
 * Time: 15:29
 */

namespace model\helper;


use enum\SiteEnvEnum;
use interfaces\ParseStringInterface;

class TemplateParser implements ParseStringInterface {

    private $openTag;
    private $closeTag;
    private $templateName;
    private $templateData;

    public function __construct(string $openTag, string $closeTag, string $templateName, array $templateData) {
        $this->openTag = $openTag;
        $this->closeTag = $closeTag;
        $this->templateName = $templateName;
        $this->templateData = $templateData;
    }


    public function parseString() :string {
        $offset = 0;
        $templateString = $this->getRawTemplate($this->templateName);

        while(strpos($templateString,$this->openTag,$offset) !== false) {
            // get the templateData[$key] to look for
            $rawDataValue = Util::getSubstringFromTags($templateString,$this->openTag,$this->closeTag,$offset);

            //trim the value to search the array correctly && store separately to allow search and replace in the string
            $key = trim($rawDataValue);

            //add the tags back on for the S&R
            $stringToReplace = $this->openTag . $rawDataValue . $this->closeTag;

            //we only want to reset if we bring in a parent template
            $resetStrPosOffset = false;


            if(strpos($key,'section::') !== false ) {

                $section = trim(Util::getSubstringFromTags($key,'::'));
                if($section == 'mainContent') {
                    $resetStrPosOffset = true;
                    $parsedString = $this->getTemplate($this->templateName);
                } else $parsedString = $this->getSection($section);

            } else {

                if($key == 'title') $parsedString = $this->templateData[$key]??SiteEnvEnum::TITLE;
                else $parsedString = $this->getValueFromData($key,$this->templateData);
            }

            $templateString = str_replace($stringToReplace,$parsedString??'',$templateString);
            /**
             * reset the offset to the length of the opening tag to avoid
             * strpos(): Offset not contained in string if string is replaced with blank
             */
            $offset = $resetStrPosOffset ? 0 : ((strpos($templateString,$this->openTag,$offset) + strlen($this->openTag)) - strlen($this->openTag)) -1;
        }
        return $templateString;
    }

    private function getValueFromData(string $key, array $data) {
        $propertyNames = explode('.',$key);
        if(count($propertyNames) == 1) return $data[$key]??null;
        else {

            $returnData = $data;

            foreach($propertyNames as $property) {
                if(is_array($returnData) && isset($returnData[$property])) $returnData = $returnData[$property];
                else if (is_object($returnData) && isset($returnData->{$property})) $returnData = $returnData->{$property};
                else {
                    $returnData = null;
                    break;
                }

            }

            return $returnData;
        }

    }

    private function getRawTemplate($name) {
        $template = file_get_contents(Util::getRoot() . 'view/templates/' . $name . '.html.php');
        $strPos = strpos($template,'extends::');

        if($strPos !== false) {
            $template = file_get_contents(Util::getRoot() . 'view/templates/' . trim(Util::getSubstringFromTags($template,'extends::',']]')) . '.main.html.php');
        }

        return $template;
    }

    private function getTemplate(string $templateName) {
        return file_get_contents(Util::getRoot() . 'view/templates/' . $templateName . '.html.php');
    }

    private function getSection($sectionName) {
        return file_get_contents(Util::getRoot() . 'view/' . $sectionName . '.html.php');
    }






}