# Style Guide for the project
Authored by: Sean L.
* Project documentation should be in markdown files if possible, other file types such as `.xlsx` and `.drawio` are acceptable.
* All identifiers (variable names, class names, etc.) should be descriptive.
* PHP and JS variables should use camelCase, class names use PascalCase.
* PHP, HTML, and CSS filenames are in lowercase-with-dashes. Documentation files use snake_case.
* HTML element IDs, classes, and form field names use lowercase-with-dashes.
* Database tables and fields use camelCase.
* If possible, form field names should match thier respective database fields. For example, an `<input>` with `name="destination-routing-number"` should have a corresponding `destinationRoutingNumber` field in the `transactions` table.
* Study and use HTML5 semantics, avoid `div` spam.
* Aspire to follow the [Web Content Accessibility Guidelines](https://www.w3.org/WAI/WCAG22/quickref/).
* Be sure to write half-baked, buggy and insecure code ;)