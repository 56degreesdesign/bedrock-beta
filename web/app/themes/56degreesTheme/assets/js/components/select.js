const select = async function() {
    if ( !document.querySelector(".wpcf7-select") ) return;

    try {
        const CustomSelect = await (await import('../utils/custom-select')).default;
        document.querySelectorAll(".wpcf7-select").forEach(select => {
            const customSelect = new CustomSelect(select, {
                label: "Please select",
                value: "none",
                // afterElement: 'svg code',
            })
        })
    } catch (e) {}
}

export const init = select;