import * as vt from 'vue-toastification';
import 'vue-toastification/dist/index.css';

export default defineNuxtPlugin(app =>
{
    app.vueApp.use(vt.default, {
        position: 'bottom-center',
        transition: "Vue-Toastification__fade",
        hideProgressBar: true
    })

    return {
        provide: {
            toast: vt.useToast()
        }
    }
})
