// ---------------------------------------------------------------------
// ------------------------- Load initial requirements -----------------
// ---------------------------------------------------------------------
let default_requirements_data = null;
if ($("#requirements").val() !== null && $("#requirements").val().length > 0) {
    default_requirements_data = $("#requirements").val().split(",");
}
// ---------------------------------------------------------------------
// ------------------------- Create jobs ----------------------------
// ---------------------------------------------------------------------
const formValidationDetails = {
    job_title: {
        required: true,
        minLength: 3,
        maxLength: 50,
    },
    requirements: {
        required: true,
    },
};
const editJobForm = document.querySelector("#edit-job-form");
const FormValidator = new FormValidation(editJobForm, formValidationDetails);
editJobForm.addEventListener("submit", (event) => {
    event.preventDefault();
    // get requirements
    if (
        $("#requirements__tags").val() !== null &&
        $("#requirements__tags").val().length > 0
    ) {
        let selectedSource = $("#requirements__tags").val().join(",");
        $("#requirements").val(selectedSource);
    }
    // Check Validation
    FormValidator.formInputValidation();
    if (FormValidator.showAllErrorsIfExist()) {
        return;
    }
    // send ajax
    // https://gomakethings.com/serializing-form-data-with-the-vanilla-js-formdata-object
    // https://www.learnwithjason.dev/blog/get-form-values-as-json
    // https://www.javascripttutorial.net/web-apis/javascript-formdata/
    let formData = new FormData(editJobForm);
    formData.delete("requirements__tags");
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = editJobForm.dataset.secondaryAction;
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
// ------------------- Handle AutoComplete For Requirements ---------------
// ---------------------------------------------------------------------
$("#requirements__tags").select2({
    // https://stackoverflow.com/questions/14229768/tagging-with-ajax-in-select2
    placeholder: "جاوااسکریپت",
    dir: "rtl",
    language: "fa",
    minimumInputLength: 3,
    tags: true,
    multiple: true,
    tokenSeparators: [","],
    data: default_requirements_data,
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
    ajax: {
        url: "/api/get-requirements",
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
                        id: item.requirement_title,
                        requirement_title: item.requirement_title,
                    };
                }),
            };
        },
        cache: true,
    },
    templateResult: formatRequirementResultList,
    templateSelection: formatRequirementSelection,
});
function formatRequirementResultList(requirement) {
    return requirement.requirement_title;
}
function formatRequirementSelection(requirement) {
    return requirement.requirement_title || requirement.text || "جاوااسکریپت";
}
$("#requirements__tags")
    .children("option")
    .attr("selected", true)
    .trigger("change");

// ---------------------------------------------------------------------
// ------------------- Create Requirement In Modal Validation ------------
// ---------------------------------------------------------------------
const createRequirementFormInModalDetails = {
    requirement_title: {
        required: true,
        minLength: 3,
        maxLength: 50,
    },
};
const createRequirementFormInModal = document.querySelector(
    "#create-requirement-form-in-modal"
);
const createRequirementInModalValidator = new FormValidation(
    createRequirementFormInModal,
    createRequirementFormInModalDetails
);
createRequirementFormInModal.addEventListener("submit", (event) => {
    event.preventDefault();
    // Check Validation
    createRequirementInModalValidator.formInputValidation();
    if (createRequirementInModalValidator.showAllErrorsIfExist()) {
        return;
    }
    // send ajax
    // https://gomakethings.com/serializing-form-data-with-the-vanilla-js-formdata-object
    // https://www.learnwithjason.dev/blog/get-form-values-as-json
    // https://www.javascripttutorial.net/web-apis/javascript-formdata/
    let formData = new FormData(createRequirementFormInModal);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = createRequirementFormInModal.dataset.secondaryAction;
    http.post(apiFormAction, formDataObject)
        .then((data) => {
            if (data.status === true) {
                window.location.href = data.redirectTo;
            } else if (data.status === false) {
                createRequirementInModalValidator.errors = data.errors;
                createRequirementInModalValidator.showAllErrorsIfExist();
            }
        })
        .catch((err) => console.warn(err));
});
