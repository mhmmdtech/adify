class FormValidation {
    constructor(form, details) {
        this.form = form;
        this.details = details;
        this.isInitialErrors = undefined;
        this.errors = {};
        this.rules = [
            "required",
            "minLength",
            "maxLength",
            "pattern",
            "confirm",
        ];
    }
    formInputValidation() {
        this.isInitialErrors = this.hideAllErrorsIfExist() ? false : true;
        for (const [key, value] of Object.entries(this.details)) {
            let currentInput = key;
            for (const [ruleKey, ruleValue] of Object.entries(value)) {
                if (this.rules.includes(ruleKey)) {
                    let validatorMethodName = `${ruleKey}Validation`;
                    let validate = this[validatorMethodName](
                        currentInput,
                        ruleValue
                    );
                    let hasError = validate?.result;
                    if (hasError && !this.errors[currentInput]) {
                        this.errors[currentInput] = validate.message;
                    }
                }
            }
        }
    }
    showAllErrorsIfExist() {
        let submitBtn = this.form.querySelector("button[type='submit']");
        submitBtn.disabled = true;
        if (this.doesFormHaveErrors() && this.isInitialErrors) {
            this.showErrorsOnUI(this.errors);
            submitBtn.disabled = false;
            return true;
        } else if (this.doesFormHaveErrors() && !this.isInitialErrors) {
            setTimeout(() => {
                this.showErrorsOnUI(this.errors);
                setTimeout(() => {
                    submitBtn.disabled = false;
                }, 250);
            }, 500);
            return true;
        }
        return false;
    }
    hideAllErrorsIfExist() {
        if (this.doesFormHaveErrors()) {
            this.hideErrorsOnUI(this.errors);
            this.errors = {};
            return true;
        }
        return false;
    }
    showErrorsOnUI(errors) {
        for (const [key, value] of Object.entries(errors)) {
            let input = this.form.querySelector(`[name=${key}]`);
            let inputGroup = get_closest_element(input, "[data-input-group]");
            let errorWrapper = inputGroup.querySelector("[data-input-error]");
            let errorSpan = document.createElement("span");
            errorSpan.textContent = Array.isArray(value) ? value[0] : value;
            errorWrapper.appendChild(errorSpan);
            errorWrapper.classList.add("show");
        }
    }
    hideErrorsOnUI(errors) {
        for (const [key, value] of Object.entries(errors)) {
            let input = this.form.querySelector(`[name=${key}]`);
            let inputGroup = get_closest_element(input, "[data-input-group]");
            let errorWrapper = inputGroup.querySelector("[data-input-error]");
            errorWrapper.classList.remove("show");
            setTimeout(() => {
                // https://dirask.com/posts/JavaScript-no-break-non-breaking-space-in-string-jMwzxD
                let child = errorWrapper.lastElementChild;
                while (child) {
                    errorWrapper.removeChild(child);
                    child = errorWrapper.lastElementChild;
                }
            }, 250);
        }
    }
    doesFormHaveErrors() {
        let hasError = Object.keys(this.errors).length > 0 ? true : false;
        return hasError;
    }
    requiredValidation(name, value) {
        let input = this.form.querySelector(`[name=${name}]`);
        let errorName = input.dataset.errorName;
        let result = null;
        if (value === true) {
            result =
                input.value.trim() === "" || input.value.trim().length === 0;
            return { result, message: `${errorName} الزامی است` };
        }
        return;
    }
    minLengthValidation(name, value) {
        let input = this.form.querySelector(`[name=${name}]`);
        let errorName = input.dataset.errorName;
        let result = null;
        result = input.value.trim().length < value;
        return {
            result,
            message: `${errorName} باید بیش‌تر از ${value} کاراکتر باشد`,
        };
    }
    maxLengthValidation(name, value) {
        let input = this.form.querySelector(`[name=${name}]`);
        let errorName = input.dataset.errorName;
        let result = null;
        result = input.value.trim().length > value;
        return {
            result,
            message: `${errorName} باید کم‌تر از ${value} کاراکتر باشد`,
        };
    }
    patternValidation(name, pattern) {
        let input = this.form.querySelector(`[name=${name}]`);
        let errorName = input.dataset.errorName;
        let result = null;
        result = !pattern.test(input.value);
        if (result) {
            return { result, message: `${errorName} نامعتبر است` };
        }
        return;
    }
    confirmValidation(name, value) {
        let input = this.form.querySelector(`[name=${name}]`);
        let confirm_input = this.form.querySelector(`[name='confirm_${name}']`);
        let errorName = input.dataset.errorName;
        let result = null;
        if (value === true) {
            result = input.value !== confirm_input.value;
            return { result, message: `${errorName} یکسان نیست` };
        }
        return;
    }
}
