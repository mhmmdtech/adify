// ---------------------------------------------------------------------
// ------------------------- Load initial requirements -----------------
// ---------------------------------------------------------------------
let default_requirements_data = null;
if ($("#requirements").val() !== null && $("#requirements").val().length > 0) {
    default_requirements_data = $("#requirements").val().split(",");
}
// ---------------------------------------------------------------------
// ------------------------- Create Job Ads ----------------------------
// ---------------------------------------------------------------------
const formValidationDetails = {
    company_id: {
        required: true,
    },
    job_id: {
        required: true,
    },
    salary: {
        required: true,
    },
    seniority: {
        required: true,
    },
    work_type: {
        required: true,
    },
    ad_url: {
        required: true,
        minLength: 5,
        maxLength: 255,
    },
    requirements: {
        required: true,
    },
    explanation: {
        maxLength: 255,
    },
};
const createAdForm = document.querySelector("#edit-ad-form");
const FormValidator = new FormValidation(createAdForm, formValidationDetails);
createAdForm.addEventListener("submit", (event) => {
    event.preventDefault();
    // get requirements
    $("#requirements").val("");
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
    let formData = new FormData(createAdForm);
    formData.delete("requirements__tags");
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = createAdForm.dataset.secondaryAction;
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
// ------------------- Handle AutoComplete For Job Title ---------------
// ---------------------------------------------------------------------
let jobSelection = $("#job_id").select2({
    placeholder: "توسعه‌دهنده فرانت‌اند",
    dir: "rtl",
    language: "fa",
    minimumInputLength: 3,
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
    ajax: {
        url: "/api/get-jobs",
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
                        job_title: item.job_title,
                    };
                }),
            };
        },
        cache: true,
    },

    templateResult: formatJobResultList,
    templateSelection: formatJobSelection,
});
function formatJobResultList(job) {
    return job.job_title;
}
function formatJobSelection(job) {
    return job.job_title || job.text || "توسعه‌دهنده فرانت‌اند";
}
// ---------------------------------------------------------------------
// ------------------------- Load initial job -----------------
// ---------------------------------------------------------------------
let default_job_data = null;
if ($("#job").val() !== null && $("#job").val().length > 0) {
    default_job_data = $("#job").val();
    const http = new EasyHTTP();
    let formDataObject = {
        q: default_job_data,
    };
    http.post("http://127.0.0.1:8000/api/job-by-id", formDataObject)
        .then((data) => {
            let option = new Option(data[0].job_title, data[0].id, true, true);
            jobSelection.append(option).trigger("change");
        })
        .catch((err) => console.warn(err));
}
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
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
    data: default_requirements_data,
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
// ------------------- Handle selectbox For salary ---------------
// ---------------------------------------------------------------------
$("#salary").select2({
    placeholder: "لطفا میزان حقوق را انتخاب نمایید",
    dir: "rtl",
    language: "fa",
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
});
// ---------------------------------------------------------------------
// ------------------- Handle selectbox For seniority ---------------
// ---------------------------------------------------------------------
$("#seniority").select2({
    placeholder: "لطفا سطح ارشدیت را انتخاب نمایید",
    dir: "rtl",
    language: "fa",
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
});
// ---------------------------------------------------------------------
// ------------------- Handle selectbox For work_type ---------------
// ---------------------------------------------------------------------
$("#work_type").select2({
    placeholder: "لطفا نوع همکاری را انتخاب نمایید",
    dir: "rtl",
    language: "fa",
    dropdownCssClass: "select2__dropdown-custom-style border-0 outline-0",
});
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
// ---------------------------------------------------------------------
// ------------------- Create Job Title In Modal Validation ------------
// ---------------------------------------------------------------------
const createJobFormInModalDetails = {
    job_title: {
        required: true,
        minLength: 3,
        maxLength: 50,
    },
};
const createJobFormInModal = document.querySelector(
    "#create-job-form-in-modal"
);
const createJobFormInModalValidator = new FormValidation(
    createJobFormInModal,
    createJobFormInModalDetails
);
createJobFormInModal.addEventListener("submit", (event) => {
    event.preventDefault();
    // Check Validation
    createJobFormInModalValidator.formInputValidation();
    if (createJobFormInModalValidator.showAllErrorsIfExist()) {
        return;
    }
    // send ajax
    // https://gomakethings.com/serializing-form-data-with-the-vanilla-js-formdata-object
    // https://www.learnwithjason.dev/blog/get-form-values-as-json
    // https://www.javascripttutorial.net/web-apis/javascript-formdata/
    let formData = new FormData(createJobFormInModal);
    const formDataObject = Object.fromEntries(formData);
    const http = new EasyHTTP();
    const apiFormAction = createJobFormInModal.dataset.secondaryAction;
    http.post(apiFormAction, formDataObject)
        .then((data) => {
            if (data.status === true) {
                window.location.href = data.redirectTo;
            } else if (data.status === false) {
                createJobFormInModalValidator.errors = data.errors;
                createJobFormInModalValidator.showAllErrorsIfExist();
            }
        })
        .catch((err) => console.warn(err));
});
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
// ---------------------------------------------------------------------
// -------- load Related Requirements after changing job title ---------
// ---------------------------------------------------------------------
$("#edit-ad-form #job_id").on("select2:select", function (event) {
    let selectedJobId = $(event.target).find(":selected").attr("value");
    selectedJobId = parseInt(selectedJobId);
    const http = new EasyHTTP();
    let formDataObject = {
        q: selectedJobId,
    };
    http.post("http://127.0.0.1:8000/api/job-by-id", formDataObject)
        .then((data) => {
            let { requirements } = data[0];
            if (requirements === null) {
                $("#requirements__tags").empty().trigger("change");
                return;
            }
            let requirementsArray = requirements.split(",");
            $("#requirements__tags").empty().trigger("change");
            $("#requirements__tags").select2({
                // https://stackoverflow.com/questions/14229768/tagging-with-ajax-in-select2
                placeholder: "جاوااسکریپت",
                dir: "rtl",
                language: "fa",
                minimumInputLength: 3,
                tags: true,
                multiple: true,
                tokenSeparators: [","],
                dropdownCssClass:
                    "select2__dropdown-custom-style border-0 outline-0",
                data: requirementsArray,
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
            $("#requirements__tags")
                .children("option")
                .attr("selected", true)
                .trigger("change");
        })
        .catch((err) => console.warn(err));
});
