export default class CustomSelect {
    constructor(element, options) {
        this.element = element;
        this.afterElement = options?.afterElement ?? "";
        this.label = options?.label ?? false;
        this.multiselect = this.element.getAttribute("multiple") ?? false;

        if ( this.element ) {
            this.createElements();
            this.attachListeners();
            this.setDefaultState();
        }
    }

    createElements() {
        this.select = this.createDivWithClass("custom-select", (this.multiselect ? "multi-select" : "single-select"));
        this.element.style.display = "none";
        this.element.parentNode.insertBefore(this.select, this.element.nextSibling);
        this.select.appendChild(document.createElement("span"));
        this.select.innerHTML += this.afterElement;
        
        this.setSelectLabel(this.label)
    }

    createDivWithClass(...className) {
        const divElement = document.createElement("div");
        divElement.classList.add(...className);
        return divElement;
    }

    attachListeners() {
        this.select.addEventListener("click", () => this.createSelectContent());
        window.addEventListener("resize", () => this.setPositionForSelectContent());
    }

    createSelectContent() {
        
        if ( this.select.classList.contains("active") ) return;
        this.selectContent = this.createUlWithClass("custom-select-content", (this.multiselect ? "multi-select" : "single-select"));
        document.body.appendChild(this.selectContent);

        this.setPositionForSelectContent();
        this.appendChildToSelectContent();
        this.closeOutSide();
        this.select.classList.add("active");

        this.selectContent.addEventListener("click", e => this.handleSelectContentClick(e));
    }

    createUlWithClass(...className) {
        const ulElement = document.createElement("ul");
        ulElement.classList.add(...className);
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
        const handleClose = (e) => {
            if ( (this.multiselect && !document.querySelector(".custom-select-content").contains(e.target)) || !this.multiselect ) {
                this.close();
                document.removeEventListener("click", handleClose);   
            }
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
        const value = e.target.dataset.value;
        if ( typeof value === "undefined") return;
        
        if ( this.multiselect ) {
            const selectedList = [];
            
            this.element.querySelectorAll("option").forEach(option => {
                if ( value === option.value ) {
                    if ( option.getAttribute("selected") === "selected" ) {
                        option.removeAttribute("selected");
                        e.target.classList.remove("selected");
                    }
                    else {
                        option.setAttribute("selected", "selected");
                        e.target.classList.add("selected");
                    }
                }
                
                if ( option.getAttribute("selected") === "selected" ) {
                    selectedList.push(option.value);
                }
            })
            
            this.setSelectLabel(selectedList.join(", "));
        }
        else {
            this.setSelectLabel(e.target.textContent);
            this.element.value = value;
            this.element.querySelectorAll("option").forEach(option => {
                if ( value === option.value ) {
                    option.setAttribute("selected", "selected");
                }
                else {
                    option.removeAttribute("selected")
                }
            })
        }
        
        let eventInput = new Event('input', { bubbles: true });
        let eventChange = new Event('change', { bubbles: true });
        this.element.dispatchEvent(eventInput);
        this.element.dispatchEvent(eventChange);
    }

    createOptionElement(option) {
        const optionElement = document.createElement("li");
        optionElement.classList.add("custom-select-content-item");
        optionElement.textContent = option.textContent;
        optionElement.dataset.value = option.value;

        if (option.getAttribute("selected") === "selected") optionElement.classList.add("selected");
        this.selectContent.appendChild(optionElement);
    }
    
    setSelectLabel(label) {
        if ( label === "" ) {
            this.select.querySelector("span").innerHTML = this.label;
        }
        else if ( label === false ) {
            this.select.querySelector("span").innerHTML = "Please select";
        }
        else {
            this.select.querySelector("span").innerHTML = label;   
        }
    }

    getCurrentSelectedElement() {
        return this.element.querySelector("option[selected]")
    }

    setDefaultState() {
        let label = "";
        const selectedList = [];

        for (const option of this.element.querySelectorAll("option")) {
            if ( option.getAttribute("selected") === "selected" ) {
                selectedList.push(option.value);
            }
        }
        
        if ( selectedList.length ) {
            label = selectedList.join(", ");
        }
        else {
            if ( this.label ) {
                label = this.label;
            }
            else if ( this.getCurrentSelectedElement()?.textContent ) {
                label = this.getCurrentSelectedElement()?.textContent;
            }
            else {
                label = this.element.querySelector("option").textContent;
                this.element.querySelector("option").setAttribute("selected", "selected");
            }
        }

        this.setSelectLabel(label);
    }
}