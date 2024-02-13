export default class CustomSelect {
    constructor(element, options) {
        this.element = element;
        this.afterElement = options?.afterElement ?? "";
        this.label = options?.label ?? false;
        this.value = options?.value ?? false;

        if ( this.element ) {
            this.createElements();
            this.attachListeners();
            this.setDefaultState();
        }
    }

    createElements() {
        this.select = this.createDivWithClass("custom-select");
        this.element.style.display = "none";
        this.element.parentNode.insertBefore(this.select, this.element.nextSibling);
        this.select.appendChild(document.createElement("span"));
        this.select.innerHTML += this.afterElement;

        this.setSelectLabel(this.label)
    }

    createDivWithClass(className) {
        const divElement = document.createElement("div");
        divElement.classList.add(className);
        return divElement;
    }

    attachListeners() {
        this.select.addEventListener("click", () => this.createSelectContent());
        window.addEventListener("resize", () => this.setPositionForSelectContent());
    }

    createSelectContent() {
        if ( this.select.classList.contains("active") ) return;
        this.selectContent = this.createUlWithClass("custom-select-content");
        document.body.appendChild(this.selectContent);

        this.setPositionForSelectContent();
        this.appendChildToSelectContent();
        this.closeOutSide();
        this.select.classList.add("active");

        this.selectContent.addEventListener("click", e => this.handleSelectContentClick(e));
    }

    createUlWithClass(className) {
        const ulElement = document.createElement("ul");
        ulElement.classList.add(className);
        return ulElement;
    }

    setPositionForSelectContent() {
        if ( !this.selectContent ) return;

        const selectRect = this.select.getBoundingClientRect();
        this.selectContent.style.left = `${selectRect.left}px`;
        this.selectContent.style.top = `${selectRect.top + window.scrollY + selectRect.height}px`;
        this.selectContent.style.width = `${selectRect.width}px`;
    }

    closeOutSide() {
        const handleClose = () => {
            this.close();
            document.removeEventListener("click", handleClose);
        }

        setTimeout(() => { document.addEventListener("click", handleClose) }, 10);
    }

    close() {
        this.selectContent.remove();
        this.select.classList.remove("active");
    }

    appendChildToSelectContent() {
        const options = this.element.querySelectorAll("option");

        options.forEach(option => this.createOptionElement(option));
    }

    handleSelectContentClick(e) {
        this.setSelectValue(e.target.dataset.value);
        this.setSelectLabel(e.target.textContent);
    }

    createOptionElement(option) {
        const optionElement = document.createElement("li");
        optionElement.classList.add("custom-select-content-item");
        optionElement.textContent = option.textContent;
        optionElement.dataset.value = option.value;

        if (option.value === this.element.value) optionElement.classList.add("selected");

        this.selectContent.appendChild(optionElement);
    }

    setSelectValue(value) {
        this.element.value = value;
        this.element.querySelectorAll("option").forEach(option => {
            if ( value === option.value ) {
                option.setAttribute("selected", "selected");
            }
            else {
                option.removeAttribute("selected")
            }
        })

        let eventInput = new Event('input', { bubbles: true });
        let eventChange = new Event('change', { bubbles: true });
        this.element.dispatchEvent(eventInput);
        this.element.dispatchEvent(eventChange);
    }

    setSelectLabel(label) {
        this.select.querySelector("span").innerHTML = label;
    }

    getCurrentSelectedElement() {
        return this.element.querySelector("option[selected]")
    }

    setDefaultState() {
        if ( this.value )
            this.setSelectValue(this.value);

        let label = "";

        if ( this.label ) {
            label = this.label
        }
        else if ( this.getCurrentSelectedElement()?.textContent ) {
            label = this.getCurrentSelectedElement()?.textContent;
        }
        else {
            label = this.element.querySelector("option").textContent;
        }

        this.setSelectLabel(label);
    }
}