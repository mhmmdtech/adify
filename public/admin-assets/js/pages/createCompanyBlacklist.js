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
const createCompanyBlacklistForm = document.querySelector(
    "#create-company-blacklist-form"
);
const FormValidator = new FormValidation(
    createCompanyBlacklistForm,
    formValidationDetails
);

createCompanyBlacklistForm.addEventListener("submit", (event) => {
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
    let formData = new FormData(createCompanyBlacklistForm);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = createCompanyBlacklistForm.dataset.secondaryAction;
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
$("#company_id").select2({
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
