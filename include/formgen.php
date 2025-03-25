<?php
/*
    formgen.php
    Code for generating simple forms.
*/

class ValidationIcon {
    public string $src;
    public string $alt;
    public function __construct(string $src, string $alt) {
        $this->src = $src;
        $this->alt = $alt;
    }
}

$susIcon = new ValidationIcon("/img/sussy.png", "Sus!");

class SimpleFormField {
    public string $type;
    public string $name;
    public string $accessibleName;
    public array $options;
    public string $errorMessage;
    public ValidationIcon | null $validationIcon;
    public bool $autofocus;
    public bool $isRequired;

    public function __construct(string $type, string $name, string $accessibleName, array $options, string $errorMessage, ValidationIcon | null $validationIcon, bool $autofocus, bool $isRequired) {
        $this->type = $type;
        $this->name = $name;
        $this->accessibleName = $accessibleName;
        $this->options = $options;
        $this->errorMessage = $errorMessage;
        $this->validationIcon = $validationIcon;
        $this->autofocus = $autofocus;
        $this->isRequired = $isRequired;
    }
    public function generateHtml(): string {

        // NOTE: This function is getting out of hand

        $fieldId = str_replace(" ", "-", strtolower($this->accessibleName))."-field";
        $errorMessageId = $fieldId."-error-message";
        $fieldName = $this->name;
        $inputType = $this->type;
        $html = "";
        $html .= "<div class=\"form-field-wrapper\" role=\"presentation\">";
        $html .= "<label for=\"$fieldId\">".$this->accessibleName."</label>";
        $html .= "<div class=\"form-input-wrapper\" role=\"presentation\">";
        if($this->options) {
            $html .= "<datalist id=\"$fieldId-options\">";
            foreach($this->options as $option) {
                $html .= "<option>$option</option>";
            }
            $html .= "</datalist>";
        }
        if($inputType == "select") {
            $html .= "<select id=\"$fieldId\"";
        } else {
            $html .= "<input id=\"$fieldId\" ";
        }
        if($this->options) {
            $html .= " list=\"$fieldId-options\" ";
        }
        $html .= " type=\"$inputType\" name=\"$fieldName\" aria-describedby=\"$errorMessageId\" ";
        if($this->isRequired) {
            $html .= " required ";
        }
        $html .= ">";
        if($inputType == "select") {
            $html .= "<option>-- Select one --</option>";
            foreach($this->options as $option) {
                $html .= "<option>$option</option>";
            }
            $html .= "</select>";
        }
        if($this->validationIcon) {
            $iconSrc = $this->validationIcon->src;
            $iconAlt = $this->validationIcon->alt;
            $html .= "<label for=\"$fieldId\"><img src=\"$iconSrc\" alt=\"$iconAlt\"></img></label>";
        }
        $html .= "</div>";
        $html .= "<div id=\"$errorMessageId\" class=\"form-error-message\" aria-live=\"polite\">".$this->errorMessage."</div>";
        $html .= "</div>";

        return $html;
    }
}

class SimpleForm {
    public string $name;
    public array $fields;
    public string $instructions;
    public string $method;
    public string $action;
    public string $submitButtonName;

    public function __construct(string $name, $fields, string $instructions, string $method, string $action, string $submitButtonName) {
        $this->name = $name;
        $this->fields = $fields;
        $this->instructions = $instructions;
        $this->method = $method;
        $this->action = $action;
        $this->submitButtonName = $submitButtonName;
    }

    public function generateHtml(): string {

        $formName = $this->name;
        $formNameId = str_replace(" ", "-", strtolower($formName))."-form";
        $submitButtonName = $this->submitButtonName;
        $method = $this->method;
        $formInstuctions = $this->instructions;
        $action = $this->action;
        $instructionsLabel = "$formName Form Instructions";
        $instructionsId = $formNameId."-instructions";
        $markFormHeaderPresentational = ($this->instructions == "");
        $html = "";
        $html .= "<section class=\"simple-form\" role=\"presentation\">";
        if($markFormHeaderPresentational) {
            $html .= "<header id=\"$instructionsId\" role=\"presentation\">";
        } else {
            $html .= "<header id=\"$instructionsId\" aria-label=\"$instructionsLabel\" role=\"region\">";
        }
        $html .= "<h2 id=\"$formNameId\">$formName</h2>";
        $html .= "<p>$formInstuctions</p>";
        $html .= "</header>";
        if(strtoupper($this->method) == "POST") {
            $enctype = "multipart/form-data";
        } else {
            $enctype = "application/x-www-form-urlencoded";
        }
        $html .= "<form method=\"$method\" action=\"$action\" enctype=\"$enctype\" aria-labelledby=\"$formNameId\" aria-describedby=\"thing\">";
        global $isVulnerableToSqlInjection;
        if($isVulnerableToSqlInjection) {
            $html .= "<!--TODO: Ensure that the user isn't typing any SQL code here-->";
        }
        foreach($this->fields as $field) {
            $html .= $field->generateHtml();
        }
        $html .= "<button type=\"submit\">$submitButtonName</button>";
        $html .= "</form>";
        $html .= "</section>";
        return $html;
    }
}