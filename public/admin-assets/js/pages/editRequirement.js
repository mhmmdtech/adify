// ---------------------------------------------------------------------
// ------------------------- Create Company Item in Blacklist ----------------------------
// ---------------------------------------------------------------------
const formValidationDetails = {
    requirement_title: {
        required: true,
        minLength: 3,
        maxLength: 50,
    },
};
const editRequirementForm = document.querySelector("#edit-requirement-form");
const FormValidator = new FormValidation(
    editRequirementForm,
    formValidationDetails
);

editRequirementForm.addEventListener("submit", (event) => {
    event.preventDefault();
    // Check Validation
    FormValidator.formInputValidation();
    if (FormValidator.showAllErrorsIfExist()) {
        return;
    }
    // send ajax
    // https://gomakethings.com/serializing-form-data-with-the-vanilla-js-formdata-object
    // https://www.learnwithjason.dev/blog/get-form-values-as-json
    // https://www.javascripttutorial.net/web-apis/javascript-formdata/
    let formData = new FormData(editRequirementForm);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = editRequirementForm.dataset.secondaryAction;
    http.post(apiFormAction, formDataObject)
        .then((data) => {
            if (data.status === true) {
                window.location.href = data.redirectTo;
            } else if (data.status === false) {
                FormValidator.errors = data.errors;
                FormValidator.showAllErrorsIfExist();
            }
        })
        .catch((err) => console.warn(err));
});
