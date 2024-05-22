export default {
    /**
     * Toast message
     * @param {Objet} dis 
     * @param {Array} response 
     * @param {string} type 
     */
    async toast(dis, response, type = 'warning') {
        dis.$helper.pop(dis, type, response.data.message);
    },
    /**
     * Handle api errors.
     * @param {Array} response
     * @param {Object} dis
     */
    async apiError(dis, response) {
        let error = response.data;
        let html = '';
        try {
            await Object.values(error.data).forEach(function (errors, key) {
                Object.values(errors).forEach(function (e, i) {
                    html += `<p class="mb-1">${e}</p>`;
                });
            });
        }
        catch (e) { }
        dis.$helper.pop(dis, 'error', error.message, html);

    },
    /**
     * Pop toast message
     * @param {Object} dis 
     * @param {string} type 
     * @param {string} message 
     * @param {string} html 
     */
    pop(dis, type, message, html = null) {
        dis.$swal.fire({
            toast: true,
            title: message,
            html: html,
            position: 'bottom',
            showConfirmButton: false,
            timer: 6000,
            showCloseButton: true,
            customClass: {
                container: type,
            },
        });
    }
}