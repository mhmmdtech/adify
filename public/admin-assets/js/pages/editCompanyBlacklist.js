// ---------------------------------------------------------------------
// ------------------------- Create Company Item in Blacklist ----------------------------
// ---------------------------------------------------------------------
const formValidationDetails = {
    company_id: {
        required: true,
    },
    explanation: {
        maxLength: 255,
    },
};
const editCompanyBlacklistForm = document.querySelector(
    "#edit-company-blacklist-form"
);
const FormValidator = new FormValidation(
    editCompanyBlacklistForm,
    formValidationDetails
);

editCompanyBlacklistForm.addEventListener("submit", (event) => {
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
    let formData = new FormData(editCompanyBlacklistForm);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = editCompanyBlacklistForm.dataset.secondaryAction;
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
// ---------------------------------------------------------------------
// --------------------- Make Textarea Height Dynamic ------------------
// ---------------------------------------------------------------------
autosize(document.querySelectorAll(".growing-height-textarea-js"));
// ---------------------------------------------------------------------
// ------------------- Handle AutoComplete For Company name ------------
// ---------------------------------------------------------------------
let companySelection = $("#company_id").select2({
    placeholder: "دیجی‌کالا",
    dir: "rtl",
    language: "fa",
    minimumInputLength: 3,
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
    ajax: {
        url: "/api/get-companies",
        dataType: "json",
        delay: 250,
        data: function (params) {
            return {
                q: $.trim(params.term),
            };
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        id: item.id,
                        company_name: item.company_name,
                    };
                }),
            };
        },
        cache: true,
    },

    templateResult: formatCompanyResultList,
    templateSelection: formatCompanySelection,
});
function formatCompanyResultList(company) {
    return company.company_name;
}
function formatCompanySelection(company) {
    return company.company_name || company.text || "دیجی‌کالا";
}
// ---------------------------------------------------------------------
// ------------------------- Load initial company -----------------
// ---------------------------------------------------------------------
let default_company_data = null;
if ($("#company").val() !== null && $("#company").val().length > 0) {
    default_company_data = $("#company").val();
    const http = new EasyHTTP();
    let formDataObject = {
        q: default_company_data,
    };
    http.post("http://127.0.0.1:8000/api/company-by-id", formDataObject)
        .then((data) => {
            console.log(data);
            let option = new Option(
                data[0].company_name,
                data[0].id,
                true,
                true
            );

            companySelection.append(option).trigger("change");
        })
        .catch((err) => console.warn(err));
}
// ---------------------------------------------------------------------
// ------------------- Create Company In Modal Validation --------------
// ---------------------------------------------------------------------
const createCompanyFormInModalDetails = {
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
const createCompanyFormInModal = document.querySelector(
    "#create-company-form-in-modal"
);
const createCompanyInModalValidator = new FormValidation(
    createCompanyFormInModal,
    createCompanyFormInModalDetails
);
createCompanyFormInModal.addEventListener("submit", (event) => {
    event.preventDefault();
    // Check Validation
    createCompanyInModalValidator.formInputValidation();
    if (createCompanyInModalValidator.showAllErrorsIfExist()) {
        return;
    }
    // send ajax
    // https://gomakethings.com/serializing-form-data-with-the-vanilla-js-formdata-object
    // https://www.learnwithjason.dev/blog/get-form-values-as-json
    // https://www.javascripttutorial.net/web-apis/javascript-formdata/
    let formData = new FormData(createCompanyFormInModal);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = createCompanyFormInModal.dataset.secondaryAction;
    http.post(apiFormAction, formDataObject)
        .then((data) => {
            if (data.status === true) {
                window.location.href = data.redirectTo;
            } else if (data.status === false) {
                createCompanyInModalValidator.errors = data.errors;
                createCompanyInModalValidator.showAllErrorsIfExist();
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
