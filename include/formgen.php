<?php
// formgen.php
// Code for generating simple forms.

class SimpleFormField {
    public string $type;
    public string $name;
    public string $accessibleName;
    public string $errorMessage;
    public string $validationIcon;
    public bool $autofocus;
    public bool $isRequired;

    public function __construct(string $type, string $name, string $accessibleName, string $errorMessage, bool $autofocus, bool $isRequired) {
        $this->type = $type;
        $this->name = $type;
        $this->accessibleName = $accessibleName;
        $this->errorMessage = $errorMessage;
        $this->autofocus = $autofocus;
        $this->isRequired = $isRequired;
    }
    public function generateHtml(): string {

        $fieldId = $this->accessibleName."-field";
        $errorMessageId = $this->accessibleName."-error-message";
        $fieldName = $this->name;
        $inputType = $this->type;
        $html = "";
        $html .= "<div class=\"form-field-wrapper\" role=\"presentation\">";
        $html .= "<label for=\"$fieldId\">".$this->accessibleName."</label>";
        $html .= "<div class=\"form-input-wrapper\" role=\"presentation\">";
        $html .= "<input id=\"$fieldId\" type=\"$inputType\" name=\"$fieldName\" aria-describedby=\"$errorMessageId\" ";
        if($this->isRequired) {
            $html .= " required ";
        }
        $html .= ">";
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
            $html .= "<header id=\"$instructionsId\" aria-label=\"$instructionsLabel\">";
        }
        $html .= "<h2 id=\"$formNameId\">$formName</h2>";
        $html .= "<p>$formInstuctions</p>";
        $html .= "</header>";
        $html .= "<form method=\"$method\" action=\"$action\" aria-labelledby=\"$formNameId\" aria-describedby=\"thing\">";
        foreach($this->fields as $field) {
            $html .= $field->generateHtml();
        }
        $html .= "<button type=\"submit\">$submitButtonName</button>";
        $html .= "</form>";
        $html .= "</section>";
        return $html;
    }
}