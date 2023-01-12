// ---------------------------------------------------------------------
// ------------------- Create Company In Modal Validation --------------
// ---------------------------------------------------------------------
const editCompanyFormDetails = {
    company_name: {
        required: true,
        minLength: 3,
        maxLength: 25,
    },
    office_population: {
        required: true,
    },
    company_url: {
        required: true,
        minLength: 5,
        maxLength: 255,
    },
    central_office: {
        required: true,
        minLength: 3,
        maxLength: 25,
    },
};
const editCompanyForm = document.querySelector("#edit-company-form");
const editCompanyValidator = new FormValidation(
    editCompanyForm,
    editCompanyFormDetails
);
editCompanyForm.addEventListener("submit", (event) => {
    event.preventDefault();
    // Check Validation
    editCompanyValidator.formInputValidation();
    if (editCompanyValidator.showAllErrorsIfExist()) {
        return;
    }
    // send ajax
    // https://gomakethings.com/serializing-form-data-with-the-vanilla-js-formdata-object
    // https://www.learnwithjason.dev/blog/get-form-values-as-json
    // https://www.javascripttutorial.net/web-apis/javascript-formdata/
    let formData = new FormData(editCompanyForm);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = editCompanyForm.dataset.secondaryAction;
    http.post(apiFormAction, formDataObject)
        .then((data) => {
            if (data.status === true) {
                window.location.href = data.redirectTo;
            } else if (data.status === false) {
                editCompanyValidator.errors = data.errors;
                editCompanyValidator.showAllErrorsIfExist();
            }
        })
        .catch((err) => console.warn(err));
});
// ---------------------------------------------------------------------
// ------------------- Handle office population in modal ---------------
// ---------------------------------------------------------------------
$("#office_population").select2({
    placeholder: "لطفا نوع همکاری را انتخاب نمایید",
    dir: "rtl",
    language: "fa",
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
});
